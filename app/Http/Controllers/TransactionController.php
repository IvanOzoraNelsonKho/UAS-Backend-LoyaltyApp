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
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input Form
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

            // 2. Hitung total harga belanja sebelum diskon
            foreach ($request->items as $item) {
                if (empty($item['reward_id'])) {
                    continue;
                }

                // Logika: Harga pokok flat Rp 30.000
                $basePrice = 30000;
                
                // Logika: Jika berukuran Large, harga ditambah Rp 5.000
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

            // 3. LOGIKA DISKON VOUCHER (Disamakan dengan kolom 'discount_value' dari model kamu)
            $discount = 0;
            if ($request->filled('voucher_id')) {
                $voucher = \App\Models\Voucher::find($request->voucher_id);
                if ($voucher) {
                    // MENGGUNAKAN discount_value sesuai isi database kamu!
                    $discount = $voucher->discount_value;
                }
            }

            // Potong total harga transaksi (tidak boleh minus di bawah 0)
            $totalPriceFinal = max(0, $totalPrice - $discount);

            // Hitung bonus poin kelipatan (1 menu = 20 poin)
            $earnedPoints = $totalItemsPurchased * 20;

            // Generate No Nota / Order ID unik
            $orderId = 'ORD-' . strtoupper(Str::random(8));

            // 4. Simpan ke tabel utama 'transactions'
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'merchant_id' => $request->merchant_id,
                'order_id' => $orderId,
                'recipient_name' => $request->recipient_name,
                'recipient_phone' => $request->recipient_phone,
                'payment_method' => $request->payment_method,
                'bank_name' => $request->payment_method === 'transfer_bank' ? $request->bank_name : null,
                'order_type' => $request->order_type,
                'total_price' => $totalPriceFinal, // Sudah terpotong diskon voucher
                'status' => 'Pesanan sedang diproses', 
            ]);

            // 5. Simpan ke tabel detail 'transaction_details'
            foreach ($detailItems as $detail) {
                $detail['transaction_id'] = $transaction->id;
                TransactionDetail::create($detail);
            }

            // 6. Mutasi penambahan poin user
            $user->point_balance += $earnedPoints;
            $user->save();

            // 7. Catat history poin masuk
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

    // 1. Fungsi untuk menampilkan halaman Dashboard Pesanan Admin
    public function adminDashboard()
    {
        // Ambil semua transaksi dari database dan urutkan dari yang paling baru
        $transactions = Transaction::with(['user', 'merchant', 'details.reward'])->latest()->get();
        
        return view('admin.orders_dashboard', compact('transactions'));
    }

    // 2. Fungsi untuk memproses perubahan status pesanan oleh Admin
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->status = $request->status;
        $transaction->save();

        return redirect()->route('admin.orders.dashboard')
                         ->with('success', 'Status Pesanan ' . $transaction->order_id . ' berhasil diperbarui menjadi: ' . $request->status);
    }

}