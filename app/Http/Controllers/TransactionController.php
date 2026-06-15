<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\PointHistory;
use App\Models\User;
use App\Models\Merchant;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TransactionController extends Controller
{
    // ini buat nampilin semua riwayat transaksi
    public function index()
    {
        // Cek jika user yang login adalah Admin (is_admin == true atau 1)
        if (auth()->user()->is_admin) {
            $transactions = Transaction::with(['user', 'merchant', 'transactionDetails.reward'])->latest()->get();
            return view('admin.orders_dashboard', compact('transactions'));
        }

        // Jika bukan admin, load pesanan milik customer itu sendiri
        $transactions = Transaction::where('user_id', auth()->id())->latest()->get();
        return view('transactions.index', compact('transactions'));
    }

    // tampilin form pesen online
    public function create()
    {
        $users = User::all();
        $merchants = Merchant::all();
        $rewards = Reward::where('stock', '>', 0)->get(); // cuman nampilin produk yg ada stok
        
        return view('transactions.create', compact('users', 'merchants', 'rewards'));
    }

    // logika checkout online
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'merchant_id' => 'required|exists:merchants,id',
            'payment_method' => 'required|in:cash,e-wallet',
            'items' => 'required|array|min:1',
            'items.*.reward_id' => 'required|exists:rewards,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // DB Transaction biar kalau ada salah satu query gagal, datanya gidak rusak/corrupt
        DB::transaction(function () use ($request) {
            $totalAmount = 0;
            $itemsToInsert = [];

            // Hitung total tiap produk dan cek stok
            foreach ($request->items as $item) {
                $product = Reward::findOrFail($item['reward_id']);
                
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stok untuk produk {$product->name} tidak mencukupi!");
                }

                $subtotal = $product->price * $item['quantity'];
                $totalAmount += $subtotal;

                // Kurangin stok produk secara langsung
                $product->decrement('stock', $item['quantity']);

                $itemsToInsert[] = [
                    'reward_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ];
            }

            // Hitung poin (tiap kelipatan Rp 10.000 dapat 10 Poin)
            $pointsEarned = floor($totalAmount / 10000);

            // Simpan ke Tabel Transactions
            $transaction = Transaction::create([
                'user_id' => $request->user_id,
                'merchant_id' => $request->merchant_id,
                'total_amount' => $totalAmount,
                'points_earned' => $pointsEarned,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
                'transaction_date' => now()->toDateString(),
            ]);

            // simpan semua item ke Tabel Transaction Details
            foreach ($itemsToInsert as $detailItem) {
                $detailItem['transaction_id'] = $transaction->id;
                TransactionDetail::create($detailItem);
            }

            // tambahin Saldo Poin ke Akun User
            $user = User::findOrFail($request->user_id);
            $user->increment('point_balance', $pointsEarned);

            // catat Mutasi Poin Masuk ke Point Histories
            PointHistory::create([
                'user_id' => $user->id,
                'type' => 'in',
                'amount' => $pointsEarned,
                'description' => "Mendapatkan poin dari pesanan online #ORD-{$transaction->id}",
            ]);
        });

        return redirect()->route('transactions.index')->with('success', 'Pesanan Online Berhasil Dibuat!');
    }

    // klu admin
    public function adminIndex() {
        $transactions = Transaction::with(['user', 'merchant', 'details.reward'])
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('admin.orders_dashboard', compact('transactions'));
    } 

    // update Status Pesanan oleh Admin atau Kasir Toko (misalnya 'processing', 'completed', 'cancelled')
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:processing,completed,cancelled'
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update(['status' => $request->status]);

        return redirect()->back()->with('success', "Status pesanan #ORD-{$id} berhasil diperbarui menjadi {$request->status}!");
    }
}