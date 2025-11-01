<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email','password');
        $remember = (bool) $request->boolean('remember');

        if (! Auth::attempt($credentials, $remember)) {
            return back()->withInput($request->only('email', 'remember'))
                         ->with('error', 'The provided credentials are incorrect.');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        // Prevent unapproved trainer from logging in
        if ($user->isTrainer() && ! $user->approved) {
            Auth::logout();
            return redirect()->route('login')->with('error','Your trainer account is pending approval.');
        }

        // Redirect based on role
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, Admin!');     
        }

        if ($user->isTrainer()) {
            return redirect()->route('trainer.dashboard')->with('success', 'Welcome back, Trainer!');
        }

        // Default: student dashboard
        return redirect()->route('student.dashboard')->with('success', 'Welcome back!');
    } 

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
