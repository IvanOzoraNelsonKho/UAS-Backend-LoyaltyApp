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
        $wishlists = Wishlist::where('user_id', auth()->id() ?? 1)->get();

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
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();

        $wishlist = new \App\Models\Wishlist();
        $wishlist->user_id = auth()->id() ?? 1; 
        $wishlist->reward_id = $request->promotion_id;
        $wishlist->save();

        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
        
        return redirect()->route('wishlists.index')->with('success', 'Berhasil ditambahkan ke Wishlist!');
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
       $wishlist = \App\Models\Wishlist::where('id', $id)->where('user_id', auth()->id() ?? 1)->firstorfail();

       $wishlist->delete();

       return redirect('/wishlists')->with('success', 'Promo berhasil dihapus dari wishlist!');
    }
}
