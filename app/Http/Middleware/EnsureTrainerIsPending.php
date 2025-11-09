<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTrainerIsPending
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // If no user is logged in, redirect to login
        if (!$user) {
            return redirect()->route('login');
        }

        // If user is an admin, redirect to admin dashboard
        if (method_exists($user, 'isAdmin') && $user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        // If user is not a trainer at all, redirect to appropriate dashboard
        if (!method_exists($user, 'isTrainer') || !$user->isTrainer()) {
            return redirect()->route('student.dashboard');
        }

        // If trainer is already approved, redirect to trainer dashboard
        if ($user->isTrainer() && $user->approved) {
            return redirect()->route('trainer.dashboard')
                ->with('message', 'Your account is already approved.');
        }

        // Only pending trainers get through to the next middleware
        return $next($request);
    }
}