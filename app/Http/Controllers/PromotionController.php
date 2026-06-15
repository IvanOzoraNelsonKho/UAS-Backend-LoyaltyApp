<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::all();
        return view('promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('promotions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'multiplier' => 'required|integer',
            'end_date' => 'required|date',
        ]);

        Promotion::create($request->all());

        return redirect()->route('promotions.index');
    }

    public function edit(Promotion $promotion)
    {
        return view('promotions.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'multiplier' => 'required|integer',
            'end_date' => 'required|date',
        ]);

        $promotion->update($validate);

        return redirect()->route('promotions.index')->with('success', 'Promo berhasil diupdate!');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        return redirect()->route('promotions.index')->with('success', 'Promo berhasil dihapus!');
    }
}
