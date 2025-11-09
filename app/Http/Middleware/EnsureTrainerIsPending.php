<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureTrainerIsPending
{
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        // If user is not logged in, redirect to login
        if (!$user) {
            abort(403, 'Unauthorized user.');
        }

        // If trainer account is pending approval, allow access to the pending page
        if ($user->isTrainer() && !$user->approved) {
            return $next($request);
        }

        // Trainer is approved, redirect to dashboard
        if ($user->isTrainer() && $user->approved) {
            return redirect()->route('trainer.dashboard');
        }

        // Redirect other roles appropriately
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('student.dashboard');
    }
}