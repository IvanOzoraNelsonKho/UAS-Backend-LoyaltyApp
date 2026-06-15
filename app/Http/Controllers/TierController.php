<?php

namespace App\Http\Controllers;

use App\Models\Tier;
use Illuminate\Http\Request;

class TierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiers = Tier::orderBy('min_points', 'asc')->get();
        
        // Cek jika user yang login adalah admin, arahkan ke view admin, jika bukan ke view customer
        if (auth()->user() && auth()->user()->is_admin == 1) {
            return view('tiers.index', compact('tiers'));
        }
        return view('tiers.show', compact('tiers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tiers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'min_points' => 'required|integer|min:0',
        ]);

        Tier::create($request->all());
        return redirect()->route('tiers.index')->with('success', 'Tier berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tier $tier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tier $tier)
    {
        return view('tiers.edit', compact('tier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tier $tier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'min_points' => 'required|integer|min:0',
        ]);

        $tier->update($request->all());
        return redirect()->route('tiers.index')->with('success', 'Tier berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tier $tier)
    {
        $tier->delete();
        return redirect()->route('tiers.index')->with('success', 'Tier berhasil dihapus!');
    }
}
