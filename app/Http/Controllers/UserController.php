<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tier;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiers = Tier::all();
        return view('users.create', compact('tiers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'point_balance' => 'required|integer|min:0',
            'tier_id' => 'required|exists:tiers,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password'),
            'point_balance' => $request->point_balance,
            'tier_id' => $request->tier_id,
        ]);

        return redirect()->route('users.index');
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
        $tiers = Tier::all();
        return view('users.edit', compact('user, tier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'point_balance' => 'required|integer|min:0',
            'tier_id' => 'required|exists:tiers,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'point_balance' => $request->point_balance,
            'tier_id' => $request->tier_id,
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
