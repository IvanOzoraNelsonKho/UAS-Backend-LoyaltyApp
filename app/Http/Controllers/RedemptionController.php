<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Redemption;

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
        return view('redemptions.create');
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
        Redemption::create([
            'user_id' => $request->user_id,
            'reward_id' => $request->reward_id,
            'merchant_id' => $request->merchant_id,
            'status' => 'pending',
        ]);
        return redirect()->route('redemptions.index');
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
        return view('redemptions.edit', compact('redemption'));
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
        $redemption->update([
            'user_id' => $request->user_id,
            'reward_id' => $request->reward_id,
            'merchant_id' => $request->merchant_id,
            'status' => $request->status,
        ]);
        return redirect()->route('redemptions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $redemption->delete();
        return redirect()->route('redemptions.index');
    }
}
