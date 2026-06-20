<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Redemption;

class RedemptionController extends Controller
{

    public function adminIndex()
    {
  
        $redemptions = Redemption::with(['user', 'reward'])->latest()->get();
        return view('admin.redemptions_dashboard', compact('redemptions'));
    }


    public function adminUpdateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,success'
        ]);

        $redemption = Redemption::findOrFail($id);
        $redemption->status = $request->status;
        $redemption->save();

        return redirect()->back()->with('success', 'Status penukaran RDM-' . str_pad($redemption->id, 4, '0', STR_PAD_LEFT) . ' berhasil diupdate jadi Sukses!');
    }

 
    public function redeemUser()
    {
        return view('redemptions.index'); // Sesuaikan kalo ada
    }
}