<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainerPendingController extends Controller
{
    public function show(Request $request)
    {
        // Retrieve trainer email from session
        $email = session('trainer_email');
        $isPending = session('trainer_pending');

        // Validate session data
        if (!$email || !$isPending) {
            return redirect()->route('login')->with('error', 'Session expired. Please log in again.');
        }

        return view('trainer.pending', [
            'email' => $email,
            'name' => ' ', 
            'created_at' => now()->format('F j, Y'),
        ]);
    }
}