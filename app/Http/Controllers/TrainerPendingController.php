<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainerPendingController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve trainer email and pending status from session
        $email = session('trainer_email');
        $isPending = session('trainer_pending', false);

        // Redirect to login if session data is missing or invalid
        if (!$email || !$isPending) {
            return redirect()->route('login')->with('error', 'Please log in with a valid trainer account.');
        }

        return view('trainer.pending', [
            'email' => $email,
        ]);
    }
}