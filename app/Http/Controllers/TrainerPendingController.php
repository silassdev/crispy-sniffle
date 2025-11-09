<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainerPendingController extends Controller
{
    /**
     * Show trainer pending page.
     */
    public function show(Request $request)
    {
        $email = session('trainer_email');
        if (!$email) {
            return redirect()->route('login')->with('error', 'Session expired. Please log in again.');
        }

        return view('trainer.pending', [
            'email' => $email,
            'created_at' => now()->format('F j, Y'),
        ]);
    }
}