<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\StudentWelcomeMail;
use App\Mail\TrainerApplicationReceivedMail;

class RegisteredUserController extends Controller
{
    public function create(Request $request)
    {
        $role = in_array($request->query('role'), ['trainer','student']) ? $request->query('role') : 'student';
        return view('auth.register', compact('role'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users'],
            'password' => ['required','confirmed', Rules\Password::defaults()],
            'role' => ['required','in:student,trainer'],
        ]);

        // Normalize role to the constant used by your User model
        $role = $request->input('role', User::ROLE_STUDENT);

        // For trainers, they must be approved by admin — set approved to false and DON'T auto-login
        $approved = $role === User::ROLE_TRAINER ? false : true;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
            'approved' => $approved,
        ]);

        // Send email (prefer queue if configured). Swallow errors so registration UI isn't blocked.
        try {
            if ($role === User::ROLE_TRAINER) {
                // Trainer: send "application received" email
                if (config('queue.default') !== 'sync') {
                    Mail::to($user->email)->queue(new TrainerApplicationReceivedMail($user));
                } else {
                    Mail::to($user->email)->send(new TrainerApplicationReceivedMail($user));
                }

                // Do not auto login trainers — they must await admin approval.
                return redirect()->route('trainer.pending')->with('success', 'Application submitted. You will be notified when your trainer account is approved.');
            } else {
                // Student: welcome email
                if (config('queue.default') !== 'sync') {
                    Mail::to($user->email)->queue(new StudentWelcomeMail($user));
                } else {
                    Mail::to($user->email)->send(new StudentWelcomeMail($user));
                }

                // Students: auto login
                Auth::login($user);
                return redirect()->intended(route('student.dashboard'))->with('success', 'Account created — welcome!');
            }
        } catch (\Throwable $e) {
            // swallow errors to avoid blocking registration UI; log for debugging
            Log::error('Mail send failed for user '.$user->email.' : '.$e->getMessage());

            // If mail fails, continue with the same UX:
            if ($role === User::ROLE_TRAINER) {
                return redirect()->route('trainer.pending')->with('success', 'Application submitted. You will be notified when your trainer account is approved.');
            } else {
                Auth::login($user);
                return redirect()->intended(route('student.dashboard'))->with('success', 'Account created — welcome!');
            }
        }
    }
}
