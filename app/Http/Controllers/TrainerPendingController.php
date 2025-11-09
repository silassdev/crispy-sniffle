<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainerPendingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('trainer.pending');
    }

    public function index(Request $request)
    {
        $user = $request->user();
        
        return view('trainer.pending', [ 
            'email' => $user->email,
            'name' => $user->name,
            'created_at' => $user->created_at->format('F j, Y'),
        ]);
    }
}