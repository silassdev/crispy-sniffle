<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Usage: ->middleware('role:student') or ->middleware('role:trainer,student')
     */
    public function handle(Request $request, Closure $next, string $roles = null)
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        if (empty($roles)) {
            return $next($request);
        }

        $allowed = array_map('trim', explode(',', $roles));
        $userRole = strtolower((string) ($request->user()->role ?? ''));

        foreach ($allowed as $r) {
            if ($r === '') continue;
            if (strtolower($r) === $userRole) {
                return $next($request);
            }
        }

        abort(Response::HTTP_FORBIDDEN, 'Unauthorized');
    }
}
