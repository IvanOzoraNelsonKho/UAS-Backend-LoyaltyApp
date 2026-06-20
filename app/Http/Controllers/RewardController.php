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
    public function adminIndex()
    {
        $rewards = \App\Models\Reward::orderBy('id', 'desc')->get();
        return view('admin.rewards_dashboard', compact('rewards'));
    }

    public function adminStore(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name' => 'required',
            'points_required' => 'required|numeric'
        ]);

        \App\Models\Reward::create([
            'name' => $request->name,
            'points_required' => $request->points_required,
            'description' => 'Deskripsi default', 
            'category_id' => 1, 
            'image' => null
        ]);

        return redirect()->back()->with('success', 'Menu baru udah masuk bos!');
    }

    public function adminDestroy($id)
    {
        $brg = \App\Models\Reward::find($id);
        if($brg) {
            $brg->delete();
        }
        
        return redirect()->back()->with('success', 'Menu sukses dibantai dari katalog!');
    }
}