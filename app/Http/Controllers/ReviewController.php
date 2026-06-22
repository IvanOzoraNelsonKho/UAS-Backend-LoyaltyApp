<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        return view('reviews.index', compact('reviews'));
    }

    public function create()
    {
        $promotions = \App\Models\Promotion::all();
        return view('reviews.create', compact('promotions'));
    }

    public function store(Request $request)
    {
       $request->validate([
        'user_id' => 'required|integer',
        'reward_id' => 'required|integer',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string',
       ]);

       Review::create($request->all());

       return redirect()->route('reviews.index');
    }

    public function edit(Review $review)
    {
        
    }

}
