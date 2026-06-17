<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // validasi lemparan dari form frontend si Joseph biar kaga diakalin
        $request->validate([
            'reward_id' => 'required'
        ]);

       
        $id_bocah = auth()->user()->id;

       
        $keranjang_lama = \App\Models\Cart::where('user_id', $id_bocah)
                                          ->where('reward_id', $request->reward_id)
                                          ->first();

        if($keranjang_lama) {
           
            $keranjang_lama->quantity = $keranjang_lama->quantity + 1;
            $keranjang_lama->save();
        } else {

            \App\Models\Cart::create([
                'user_id' => $id_bocah,
                'reward_id' => $request->reward_id,
                'quantity' => 1
            ]);
        }

     
        return redirect()->back()->with('Asik masuk keranjang gausah ragu raguu langsung check out aja');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
   
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
    public function checkout()
    {
        $id_bocah = auth()->user()->id;
        $user = auth()->user();

       
        $keranjang = \App\Models\Cart::where('user_id', $id_bocah)->get();

        
        if($keranjang->count() == 0) {
            return redirect()->back()->with('error', 'Keranjang lu kosong woi, mau nuker angin?!');
        }

       
        $total_poin = 0;
        foreach($keranjang as $item) {
            
            $harga_minuman = \App\Models\Reward::find($item->reward_id)->points_required;
            $total_poin = $total_poin + ($harga_minuman * $item->quantity);
        }


        if($user->points < $total_poin) {
            return redirect()->back()->with('error', 'Poin lu miskin obos! Kaga cukup buat nuker ginian.');
        }

        
        $user->points = $user->points - $total_poin;
        $user->save();

       
        foreach($keranjang as $item) {
            $harga_minuman = \App\Models\Reward::find($item->reward_id)->points_required;
            
            \App\Models\Redemption::create([
                'user_id' => $id_bocah,
                'reward_id' => $item->reward_id,
                'points_used' => $harga_minuman * $item->quantity,
            ]);
        }

      
        \App\Models\Cart::where('user_id', $id_bocah)->delete();

        return redirect()->back()->with('success', 'Asik! Berhasil nuker poin! Silakan ambil GAGA Thai Tea lu!');
    }
}
