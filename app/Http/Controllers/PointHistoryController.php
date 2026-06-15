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
}
