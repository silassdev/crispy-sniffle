<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainerPendingController extends Controller
{
    /**
     * Show the trainer pending page.
     */
    public function show(Request $request)
    {
        // Your application logic can fetch the email/user details here
        $email = $request->session()->get('trainer_email');
        $created_at = now()->format('F j, Y'); // Replace with real data if available
        $name = 'Trainer'; // Replace with real trainer name if available

        return view('trainer.pending', [
            'email' => $email,
            'name' => $name,
            'created_at' => $created_at,
        ]);
    }
}