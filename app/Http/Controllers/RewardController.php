<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index()
    {
        $menus = \App\Models\Reward::all();
        return view('rewards.index', compact('menus'));
    }


}