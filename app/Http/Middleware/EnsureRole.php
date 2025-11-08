<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureRole
{
    /**
     * Ensure the authenticated user has one of the allowed roles.
     * Usage: ->middleware(['auth','role:student'])
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {   
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        $allowed = array_map('strval', $roles);

        if (! in_array($user->role, $allowed, true)) 
            {

                return response()->view('errors.forbidden_role', [
                    'userRole' => $user->role,
                    'requiredRoles' => $allowed,
                ], 403);
        }

        return $next($request);
    }
}
