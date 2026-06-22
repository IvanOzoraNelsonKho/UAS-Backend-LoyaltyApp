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
        $user = auth()->user();
        $keranjang = \App\Models\Cart::where('user_id', $user->id)->get();

        $total_poin = 0;
        $cart_items = []; 

        foreach($keranjang as $item) {
            $reward = \App\Models\Reward::find($item->reward_id);
            if($reward) {
                $subtotal = $reward->points_required * $item->quantity;
                $total_poin = $total_poin + $subtotal;
                
                $cart_items[] = (object) [
                    'nama_minuman' => $reward->name, // Asumsi kolom nama minuman di tabel rewards itu 'name'
                    'poin_satuan' => $reward->points_required,
                    'qty' => $item->quantity,
                    'subtotal' => $subtotal
                ];
            }
        }

        return view('cart.index', compact('cart_items', 'total_poin', 'user'));
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
        return redirect()->back()->with('success', 'Asik masuk keranjang gausah ragu raguu langsung check out aja');
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
        $user = auth()->user();
        $id_bocah = $user->id;
        $keranjang = \App\Models\Cart::where('user_id', $id_bocah)->get();
        
        if($keranjang->count() == 0) {
            return redirect()->back()->with('error', 'Keranjang lu kosong woi!');
        }
        
        $total_poin = 0;
        foreach($keranjang as $item) {
            $harga_minuman = \App\Models\Reward::find($item->reward_id)->points_required;
            $total_poin = $total_poin + ($harga_minuman * $item->quantity);
        }
        
        if($user->point_balance < $total_poin) {
            return redirect()->back()->with('error', 'Poin lu miskin obos!');
        }
      
        $user->point_balance = $user->point_balance - $total_poin;
        $user->save();
        
        
        foreach($keranjang as $item) {
            $harga_minuman = \App\Models\Reward::find($item->reward_id)->points_required;
            
            \App\Models\Redemption::create([
                'user_id' => $id_bocah,
                'reward_id' => $item->reward_id,
                'points_spent' => $harga_minuman * $item->quantity, // Sekarang udah kaga bakal jadi 0 lagi!
                'status' => 'success', 
            ]);
        }

       
        \App\Models\PointHistory::create([
            'user_id' => $id_bocah,
            'type' => 'out', 
            'amount' => $total_poin,
            'description' => 'Penukaran poin untuk ' . $keranjang->count() . ' item minuman'
        ]);
        
      
        \App\Models\Cart::where('user_id', $id_bocah)->delete();

        return redirect('/transactions')->with('success', 'Asik! Berhasil nuker poin! Silakan cek riwayat lu di bawah!');
    }
}