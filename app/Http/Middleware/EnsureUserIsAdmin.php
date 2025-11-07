<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user() || ! method_exists($request->user(), 'isAdmin') || ! $request->user()->isAdmin()) {
            abort(403);
        }

        return $next($request);
    }
}
