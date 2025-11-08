<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class TrainerRegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:190',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => User::ROLE_TRAINER,
                'approved' => false,
            ]);

            // log for debugging
            Log::info('TrainerRegisterController: created trainer', ['email' => $user->email, 'id' => $user->id]);

            // flash success and redirect to pending
            session()->flash('trainer_email', $user->email);
            session()->flash('success', 'Application submitted. An administrator will review your profile.');

            return redirect()->route('trainer.pending');
        } catch (\Throwable $e) {
            Log::error('Trainer register failed: '.$e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Unable to create account.']);
        }
    }
}
