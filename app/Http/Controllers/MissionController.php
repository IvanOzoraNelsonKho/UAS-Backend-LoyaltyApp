<?php

namespace App\Http\Controllers;

use App\Models\Mission;
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

        return redirect()->route('missions.index');
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

        return redirect()->route('missions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mission $mission)
    {
        $mission->delete();
        return redirect()->route('missions.index');
    }
}
