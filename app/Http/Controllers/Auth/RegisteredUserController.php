<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create(Request $request)
    {
        // role prefill from ?role=trainer or ?role=student
        $role = in_array($request->query('role'), ['trainer', 'student']) ? $request->query('role') : 'student';
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

        $role = $request->input('role', 'student');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
            // Trainers require admin approval before they can publish/manage content
            'approved' => $role === User::ROLE_TRAINER ? false : true,
        ]);

        // Auto-login
        Auth::login($user);

        // Redirect to profile completion step or role dashboard
        if ($user->isTrainer() && ! $user->approved) {
            return redirect()->route('trainer.pending')->with('success', 'Registration received. Await admin approval.');
        }

        return redirect()->intended(route($this->redirectFor($user)));
    }

    protected function redirectFor(User $user)
    {
        if ($user->isAdmin()) return 'admin.dashboard';
        if ($user->isTrainer()) return 'trainer.dashboard';
        return 'student.dashboard';
    }
}
