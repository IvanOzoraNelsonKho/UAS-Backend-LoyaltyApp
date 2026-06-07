<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\User;
use App\Models\PointHistory;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $missions = Mission::all();
        return view('missions.index', compact('missions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('missions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'reward_points' => 'required|integer|min:0',
            'status' => 'required|boolean'
        ]);

        Mission::create([
            'title' => $request->title,
            'description' => $request->description,
            'reward_points' => $request->reward_points,
            'status' => $request->status
        ]);

        return redirect()->route('missions.index')->with('success', 'Misi baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mission $mission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mission $mission)
    {
        return view('missions.edit', compact('mission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mission $mission)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'reward_points' => 'required|integer|min:0',
            'status' => 'required|boolean'
        ]);

        $mission->update([
            'title' => $request->title,
            'description' => $request->description,
            'reward_points' => $request->reward_points,
            'status' => $request->status
        ]);

        return redirect()->route('missions.index')->with('success', 'Misi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mission $mission)
    {
        $mission->delete();
        return redirect()->route('missions.index')->with('success', 'Misi berhasil dihapus!');
    }

    /**
     * Process mission reward claim for the customer.
     */
    public function claim($id)
    {
        $mission = Mission::findOrFail($id);
        
        // Menggunakan user yang sedang login, jika tidak ada (untuk keperluan tes), ambil user pertama di DB
        $user = auth()->user() ?? User::first(); 

        if (!$user) {
            return redirect()->route('missions.index')->with('error', 'User tidak ditemukan. Pastikan sudah menjalankan seeder.');
        }

        // 1. Tambahkan saldo poin user
        $user->point_balance += $mission->reward_points;
        $user->save();

        // 2. Catat mutasi masuk ke riwayat poin (Tabel point_histories)
        PointHistory::create([
            'user_id' => $user->id,
            'type' => 'in',
            'amount' => $mission->reward_points,
            'description' => 'Klaim Hadiah Misi: ' . $mission->title
        ]);

        return redirect()->route('missions.index')->with('success', 'Poin berhasil diklaim! Saldo poin Anda bertambah sebesar ' . $mission->reward_points . ' Pts.');
    }
}