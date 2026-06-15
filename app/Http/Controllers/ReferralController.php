<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Referral;
use App\Models\User;
use App\Models\PointHistory;
use Illuminate\Support\Facades\DB;

class ReferralController extends Controller
{
    // admin melihat data daftar user & history referral
    public function index()
    {
        $referrals = Referral::with(['referrer', 'referred'])->latest()->get();
        
        // admin bisa melihat point history customer dengan mengklik user (is_admin = false)
        $users = User::where('is_admin', false)->get(); 
        return view('admin.referrals_index', compact('referrals', 'users'));
    }

    // customer klaim input kode referral teman
    public function processReferral(Request $request)
    {
        $request->validate([
            'referrer_code' => 'required|exists:users,referral_code',
        ]);

        // ambil data user login dan pemilik kode
        $referred = auth()->user(); 
        $referrer = User::where('referral_code', $request->referrer_code)->first();

        if ($referred->is_admin) {
            return redirect()->back()->with('error', 'Akun Admin tidak menggunakan sistem referral.');
        }

        // gabolehin user mskin code referral milik sendiri
        if ($referrer->id === $referred->id) {
            return redirect()->back()->with('error', 'Tidak bisa menggunakan kode referral sendiri.');
        }
    
        // buat cegah klaim dua kali (Tiap orang hanya klaim punya teman 1 kali)
        $alreadyClaimed = Referral::where('referred_id', $referred->id)->exists();
        if ($alreadyClaimed) {
            return redirect()->back()->with('error', 'Anda sudah pernah mengklaim kode referral.');
        }

        // proses transaksi database 
        DB::transaction(function () use ($referrer, $referred) {
            $bonusForReferrer = 50; // bonus buat yg ngajak
            $bonusForReferred = 20;  // bonus buat yg diajak

            // catat data ke tabel referrals
            Referral::create([
                'referrer_id' => $referrer->id,
                'referred_id' => $referred->id,
                'reward_points_earned' => $bonusForReferrer,
            ]);

            // nambah saldo poin yang mengajak di tabel users 
            $referrer->increment('point_balance', $bonusForReferrer);
            PointHistory::create([
                'user_id' => $referrer->id,
                'type' => 'in', 
                'amount' => $bonusForReferrer,
                'description' => 'Bonus referral mengundang teman: ' . $referred->name,
            ]);

            // nambah saldo poin buat user baru yang mengklaim kode + masuk point history
            $referred->increment('point_balance', $bonusForReferred);
            PointHistory::create([
                'user_id' => $referred->id,
                'type' => 'in', 
                'amount' => $bonusForReferred,
                'description' => 'Bonus mendaftar menggunakan kode referral dari: ' . $referrer->name,
            ]);
        });

        return redirect()->back()->with('success', 'Kode referral berhasil diklaim! Kedua belah pihak berhasil mendapatkan bonus poin.');
    }
}