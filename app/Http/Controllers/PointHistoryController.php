<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PointHistory;

class PointHistoryController extends Controller
{
    public function index()
    {
        $currentCustomerId = auth()->id();
        //buat ambil semua riwayat poin punya customer yang login terus urutin dari paling baru
        $pointHistories = PointHistory::where('user_id', $currentCustomerId)->latest()->get();

        return view('point_histories.index', compact('pointHistories'));
    }
    // Fungsi khusus Admin untuk melihat riwayat poin user tertentu
    public function adminUserHistory($id)
    {
        // Cari data user, jika tidak ketemu akan memunculkan error 404
        $user = \App\Models\User::findOrFail($id);
        
        // Ambil semua riwayat poin milik user tersebut, urutkan dari yang paling baru
        $pointHistories = PointHistory::where('user_id', $id)->latest()->get();

        return view('admin.user_point_history', compact('user', 'pointHistories'));
    }
}
