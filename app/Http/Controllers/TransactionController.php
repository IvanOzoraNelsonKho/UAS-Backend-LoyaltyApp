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
        $currentCustomerId = auth()->id(); // ambil ID user yang sedang login
        $transactions = Transaction::where('user_id', $currentCustomerId)->latest()->get();
        //latest()->get(): itu buat ambil semua data transaksi yg urutan nya tuh otomatis dari paling baru ke paling lama, jadi kita bisa liat transaksi terbaru di paling atas
        
        return view('transactions.index', compact('transactions'));
    }

    // form input transaksi baru
    public function create()
    {
        return view('transactions.create');
    }

    // simpan data transaksi ke database + nambah poin
    public function store(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required|string|unique:transactions,invoice_number',
            'total_amount' => 'required|numeric|min:0',
        ], [
            'invoice_number.unique' => 'Nomor nota sudah pernah diklaim sebelumnya!',
        ]);

        // tetapkan user_id otomatis ke id customer yang sedang login
        $currentCustomerId = auth()->id();
        $user = User::find($currentCustomerId);

        // tiap kelipatan Rp 10.000 dapat 10 poin
        $pointsEarned = floor($request->total_amount / 10000) * 10;

        // simpan data ke tabel transactions
        Transaction::create([
            'user_id' => $currentCustomerId,
            'invoice_number' => $request->invoice_number,
            'total_amount' => $request->total_amount,
            'points_earned' => $pointsEarned,
            'transaction_date' => now()->toDateString(),
        ]);

        // update saldo poin di tabel users
        if ($pointsEarned >0) {
            $user->increment('point_balance', $pointsEarned);
            // catat histori poin masuk ke tabel point_histories
            PointHistory::create([
                'user_id' => $currentCustomerId,
                'type' => 'in',
                'amount' => $pointsEarned,
                'description' => "Poin dari transaksi #TRX-{$request->invoice_number}"
            ]);
        }

        return redirect()->route('transactions.index')->with('success', 'Nota #' . $request->invoice_number . ' berhasil disimpan dan poin telah ditambahkan!' . $pointsEarned . ' Pts');
    }
}