<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainerPendingController extends Controller
{
    /**
     * Show the trainer pending page (application received).
     */
    public function index(Request $request)
    {
        // You can pass extras (email, status) if you want:
        $email = session('trainer_email') ?? $request->query('email');

        return view('auth.trainer_pending', [
            'email' => $email,
        ]);
    }
}
