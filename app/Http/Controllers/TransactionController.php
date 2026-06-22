<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Models\PointHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
  public function index()
    {
       
        $transactions = Transaction::where('user_id', Auth::id())->latest()->get();
        $redemptions = \App\Models\Redemption::where('user_id', Auth::id())->latest()->get();
        return view('transactions.index', compact('transactions', 'redemptions'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => 'required|string',
            'merchant_id' => 'required|integer',
            'order_type' => 'required|string',
            'payment_method' => 'required|string',
            'bank_name' => 'nullable|string',
            'voucher_id' => 'nullable|integer|exists:vouchers,id', 
            'items' => 'required|array|min:1',
            'items.*.reward_id' => 'nullable|integer',
            'items.*.size' => 'required|in:reguler,large',
            'items.*.ice_level' => 'required|in:normal,less', 
            'items.*.sugar_level' => 'required|in:normal,less', 
        ]);

        $user = Auth::user() ?? User::first(); 
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        DB::beginTransaction();
        try {
            $totalPrice = 0;
            $totalItemsPurchased = 0;
            $detailItems = [];

            
            foreach ($request->items as $item) {
                if (empty($item['reward_id'])) {
                    continue;
                }

               
                $basePrice = 30000;
                
               
                $addSizePrice = ($item['size'] === 'large') ? 5000 : 0;
                
                $pricePerUnit = $basePrice + $addSizePrice;
                $quantity = 1; 
                $subtotal = $pricePerUnit * $quantity;

                $totalPrice += $subtotal;
                $totalItemsPurchased += $quantity;

                $detailItems[] = [
                    'reward_id' => $item['reward_id'],
                    'quantity' => $quantity,
                    'size' => $item['size'],
                    'ice_level' => $item['ice_level'],
                    'sugar_level' => $item['sugar_level'],
                ];
            }

            if ($totalItemsPurchased === 0) {
                return redirect()->back()->with('error', 'Anda harus memilih minimal satu menu.');
            }

           
            $discount = 0;
            if ($request->filled('voucher_id')) {
                $voucher = \App\Models\Voucher::find($request->voucher_id);
                if ($voucher) {
                    $discount = $voucher->discount_value;
                }
            }

           
            $totalPriceFinal = max(0, $totalPrice - $discount);

         
            $earnedPoints = $totalItemsPurchased * 20;

           
            $orderId = 'ORD-' . strtoupper(Str::random(8));

           
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'merchant_id' => $request->merchant_id,
                'order_id' => $orderId,
                'recipient_name' => $request->recipient_name,
                'recipient_phone' => $request->recipient_phone,
                'payment_method' => $request->payment_method,
                'bank_name' => $request->payment_method === 'transfer_bank' ? $request->bank_name : null,
                'order_type' => $request->order_type,
                'total_price' => $totalPriceFinal, 
                'status' => 'Pesanan sedang diproses', 
            ]);

           
            foreach ($detailItems as $detail) {
                $detail['transaction_id'] = $transaction->id;
                TransactionDetail::create($detail);
            }

            $user->point_balance += $earnedPoints;
            $user->save();

           
            PointHistory::create([
                'user_id' => $user->id,
                'type' => 'in',
                'amount' => $earnedPoints,
                'description' => 'Poin Pembelian Online ' . $orderId . ' (' . $totalItemsPurchased . ' Menu)'
            ]);

            DB::commit();

            return redirect()->route('transactions.index')
                             ->with('success', 'Pesanan berhasil dibuat! Potongan Rp ' . number_format($discount, 0, ',', '.') . ' diterapkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }

    public function adminDashboard()
    {
        
        $transactions = Transaction::with(['user', 'merchant', 'details.reward'])->latest()->get();
        
        return view('admin.orders_dashboard', compact('transactions'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->status = $request->status;
        $transaction->save();

        return redirect()
        ->route('admin.orders.dashboard')
        ->with('success', 'Status Pesanan ' . $transaction->order_id . ' berhasil diperbarui menjadi: ' . $request->status);
    }

}