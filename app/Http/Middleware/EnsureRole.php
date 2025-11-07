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
    public function handle(Request $request, Closure $next, $role)
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        $roles = explode('|', $role); // support role1|role2
        if (! in_array($request->user()->role, $roles)) {
            abort(403);
        }

        return $next($request);
    }
}
