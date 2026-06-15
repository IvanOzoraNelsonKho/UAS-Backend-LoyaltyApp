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
        // Mengambil semua user beserta relasi tier-nya agar bisa memunculkan nama tier-nya
        $users = User::with('tier')->get();
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
            'password' => 'required|string|min:6',
            'point_balance' => 'required|integer|min:0',
            'tier_id' => 'required|exists:tiers,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
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
        $loggedInUser = auth()->user();

    //  Proteksi Customer: Jika BUKAN admin, dan ID yang dibuka BUKAN ID-nya sendiri, langsung blokir!
    if (!$loggedInUser->is_admin && $loggedInUser->id != $id) {
        return redirect()->route('users.show', $loggedInUser->id)->with('error', 'Anda tidak diizinkan melihat kartu member milik orang lain!');
    }

    $user = User::with('tier')->findOrFail($id);
    return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Cari data user berdasarkan ID terlebih dahulu agar tidak error
        $user = User::findOrFail($id);
        $tiers = Tier::all();
        return view('users.edit', compact('user', 'tiers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Cari data user berdasarkan ID terlebih dahulu
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'point_balance' => 'required|integer|min:0',
            'tier_id' => 'required|exists:tiers,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'point_balance' => $request->point_balance,
            'tier_id' => $request->tier_id,
        ]);

        if ($request->filled('password')) {
            $updateData['password'] = bcrypt($request->password);
        }

        $user->update($updateData);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mengambil data user ke-1 beserta relasi tier membership-nya
        $user = User::with('tier')->findOrFail($id);
    
        // Mengembalikan ke file view show.blade.php
        return view('users.show', compact('user'));
    }
}
