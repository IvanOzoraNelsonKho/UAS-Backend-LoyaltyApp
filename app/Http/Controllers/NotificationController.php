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
        Notification::create([
            'user_id' => $request->user_id,
            'message' => $request->message,
            'is_read' => $request->is_read,
        ]);

         return redirect()->route('notifications.index');
    } 
    
}
