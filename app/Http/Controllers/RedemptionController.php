<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Redemption;
use App\Models\User;    
use App\Models\Reward;

class RedemptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $redemptions = Redemption::all();
        return view('redemptions.index', compact('redemptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = \App\Models\User::all();
        $rewards = \App\Models\Reward::all(); 
        $merchants = \App\Models\Merchant::all();
        return view('redemptions.create', compact('users', 'rewards', 'merchants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'reward_id' => 'required|integer',
            'merchant_id' => 'required|integer',
        ]);

        $user = User::findOrFail($request->user_id);
        $reward = Reward::findOrFail($request->reward_id);
        if ($user->point_balance >= $reward->points_required) {
            $user->point_balance = $user->point_balance - $reward->points_required;
            $user->save();

            Redemption::create([
                'user_id' => $request->user_id,
                'reward_id' => $request->reward_id,
                'merchant_id' => $request->merchant_id,
                'status' => 'pending',
            ]);
            return redirect()->route('redemptions.index')->with('success', 'Reward berhasil ditukar! Poin telah dipotong.');
        } 
        else {
            return redirect()->back()->with('error', 'Maaf, poin Anda tidak mencukupi untuk menukar reward.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $redemption = Redemption::findOrFail($id);
        $users = \App\Models\User::all();
        $rewards = \App\Models\Reward::all(); 
        $merchants = \App\Models\Merchant::all();
        return view('redemptions.edit', compact('redemption', 'users', 'rewards', 'merchants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'reward_id' => 'required|integer',
            'merchant_id' => 'required|integer',
            'status' => 'required|in:pending,success',
        ]);
        $redemption = Redemption::findOrFail($id);
        $oldStatus = $redemption->status;
        $newStatus = $request->status;
        $redemption->update([
            'user_id' => $request->user_id,
            'reward_id' => $request->reward_id,
            'merchant_id' => $request->merchant_id,
            'status' => $request->status,
        ]);

        if ($oldStatus == 'pending' && $newStatus == 'success') {
            $reward = \App\Models\Reward::find($redemption->reward_id);
            if ($reward && $reward->stock > 0) {
                $reward->stock -= 1; 
                $reward->save();
            }
        } 
        return redirect()->route('redemptions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $redemption = Redemption::findOrFail($id);
        $redemption->delete();
        return redirect()->route('redemptions.index');
    }

    public function redeemUser()
    {
        $users = \App\Models\User::all();
        $rewards = \App\Models\Reward::all();
        $merchants = \App\Models\Merchant::all();
        return view('redemptions.redeem', compact('users', 'rewards', 'merchants'));
    }
}
