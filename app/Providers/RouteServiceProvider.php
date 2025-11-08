<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        // Ensure 'role' route middleware alias exists (fallback)
        $this->app['router']->aliasMiddleware('role', \App\Http\Middleware\EnsureRole::class);

        // Also ensure other custom aliases (optional)
        $this->app['router']->aliasMiddleware('is_admin', \App\Http\Middleware\EnsureUserIsAdmin::class);
        $this->app['router']->aliasMiddleware('validate.token', \App\Http\Middleware\ValidateToken::class);
    }
}

