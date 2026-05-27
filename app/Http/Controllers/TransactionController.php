<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\PointHistory;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // ini buat nampilin semua riwayat transaksi
    public function index()
    {
        $transactions = Transaction::with('user')->latest()->get(); 
        //latest()->get(): itu buat ambil semua data transaksi yg urutan nya tuh otomatis dari paling baru ke paling lama, jadi kita bisa liat transaksi terbaru di paling atas
        return view('transactions.index', compact('transactions'));
    }

    // form input transaksi baru
    public function create()
    {
        $users = User::all(); // buat ambil data user untuk pilihan di form
        return view('transactions.create', compact('users'));
    }

    // simpan data transaksi ke database + nambah poin
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_amount' => 'required|numeric|min:0',
        ]);

        // tiap kelipatan Rp 10.000 dapat 10 poin
        $pointsEarned = floor($request->total_amount / 10000) * 10;

        // simpan data ke tabel transactions
        Transaction::create([
            'user_id' => $request->user_id,
            'total_amount' => $request->total_amount,
            'points_earned' => $pointsEarned,
            'transaction_date' => now(),
        ]);

        // update saldo poin di tabel users
        $user = User::find($request->user_id);
        $user->increment('point_balance', $pointsEarned);

        // catat histori poin masuk ke tabel point_histories
        PointHistory::create([
            'user_id' => $request->user_id,
            'type' => 'in',
            'amount' => $pointsEarned,
            'description' => 'Mendapatkan poin dari transaksi sebesar Rp ' . number_format($request->total_amount, 0, ',', '.'),
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan dan poin telah ditambahkan!');
    }
}