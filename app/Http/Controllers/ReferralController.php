<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Referral;
use App\Models\User;
use App\Models\PointHistory;
use Illuminate\Support\Facades\DB;

class ReferralController extends Controller
{
    public function processReferral(Request $request){
        $request->validate([
            'referrer_code' => 'required|exists:users,referral_code',
        ]);

        // cari tau siapa yg punya kode referral itu
        $referrer = User::where('referral_code', $request->referrer_code)->first();
        $referred == auth()->user();

        // gabolehin user mskin code referral milik sendiri
        if ($referrer->id === $referred->id) {
            return redirect()->back()->with('error', 'Tidak bisa menggunakan kode referral sendiri.');
        }
    
        // bantu cegah klaim dua kali p
        $alreadyClaimed = Referral::where('referred_id', $referred->id)->exists();
        if ($alreadyClaimed) {
            return redirect()->back()->with('error', 'Anda sudah pernah mengklaim kode referral.');
        }

        DB::transaction(function () use ($referrer, $referred) {
            $bonusPoints = 50; // Nominal bonus poin undang teman

            // catat data ke tabel referrals
            Referral::create([
                'referrer_id' => $referrer->id,
                'referred_id' => $referred->id,
                'reward_points_earned' => $bonusPoints,
            ]);

            // nambah saldo poin yg ngundang di tabel users
            $referrer->increment('points', $bonusPoints);

            // log riwayat poin ke PointHistory 
            PointHistory::create([
                'user_id' => $referrer->id,
                'type' => 'in',
                'amount' => $bonusPoints,
                'description' => 'Bonus mengundang teman: ' . $referred->name,
            ]);
        });

        return redirect()->back()->with('success', 'Kode referral berhasil diklaim! Bonus poin telah dikirim ke pengundang.');
    }
}
