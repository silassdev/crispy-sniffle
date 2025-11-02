<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use App\Models\User;

class RegisteredUserController extends Controller
{
    public function create(Request $request)
    {
        $role = in_array($request->query('role'), ['trainer','student']) ? $request->query('role') : 'student';
        return view('auth.register', compact('role'));
    }

    /**
     * Store a new user (student or trainer).
     * This method is defensive: explicit validation, try/catch, logging,
     * and repack validation messages to session('error') so toast shows them.
     */
    public function store(Request $request)
    {
        Log::info('Registration attempt', ['ip' => $request->ip(), 'input' => $request->only('email','role','name')]);

        $validator = Validator::make($request->all(), [
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users'],
            'password' => ['required','confirmed', Rules\Password::defaults()],
            'role' => ['required','in:student,trainer'],
            // add more rules if needed
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors()->all();
            $msg = implode(' - ', $messages);

            Log::warning('Registration validation failed', ['email' => $request->input('email'), 'errors' => $messages]);

            // Send user back with input and a toast-ready error message (so toast appears)
            return back()
                ->withInput($request->except('password','password_confirmation'))
                ->with('error', $msg);
        }

        try {
            $role = $request->input('role', User::ROLE_STUDENT);
            $approved = $role === User::ROLE_TRAINER ? false : true;

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $role,
                'approved' => $approved,
            ]);

            Log::info('User created', ['id' => $user->id, 'email' => $user->email, 'role' => $role]);

            // Send queued mail or immediate (if configured) if you have mailables - optional

            if ($role === User::ROLE_TRAINER) {
                // flash email for trainer pending page
                session()->flash('trainer_email', $user->email);
                return redirect()->route('trainer.pending')->with('success', 'Application submitted. An admin will review your application.');
            }

            // Student: auto-login
            Auth::login($user);
            return redirect()->route('student.dashboard')->with('success', 'Account created — welcome!');

        } catch (\Throwable $e) {
            // Log full exception and show friendly toast
            Log::error('Registration error: '.$e->getMessage(), [
                'exception' => $e,
                'input' => $request->only('email','role','name')
            ]);

            // If APP_DEBUG true, you might want to rethrow to see full trace. For now, show toast.
            return back()
                ->withInput($request->except('password','password_confirmation'))
                ->with('error', 'Registration failed: ' . ($e->getMessage() ?: 'server error'));
        }
    }
}
