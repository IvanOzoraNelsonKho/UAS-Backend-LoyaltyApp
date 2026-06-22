<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notification = Notification::all();
        return view('notifications.index', compact('notification'));
    }

    public function create()
    {
        return view('notifications.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }
        
        $request->validate([
            'user_id' => 'required|integer',
            'message' => 'required|string',
            'is_read' => 'required|boolean',
        ]);

        Notification::create($request->all());
        
        return redirect()->route('notifications.index');
    }
}
