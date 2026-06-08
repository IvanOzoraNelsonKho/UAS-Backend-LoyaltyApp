<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlists = Wishlist::where('user_id', auth()->id())->get();

        return view('wishlists.index', compact('wishlists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reward_id' => 'required|integer',
        ]);

        $sudahAda = Wishlist::where('user_id', auth()->id())
                            ->where('reward_id', $request->reward_id)
                            ->first();
        
        if (!$sudahAda) {
            Wishlist::create([
                'user_id' => auth()->id(),
                'reward_id' => $request->reward_id,
            ]);

        }

        return back(->with('success', 'Berhasil ditambahkan ke Wishlist!'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

