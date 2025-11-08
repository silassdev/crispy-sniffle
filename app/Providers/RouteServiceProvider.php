<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // keep existing logic if any, then ensure aliases
        // call parent::boot() if your class extends the base provider and already calls it
        if (method_exists(parent::class, 'boot')) {
            parent::boot();
        }

        // Force-register route middleware aliases so they always exist
        $this->app['router']->aliasMiddleware('role', \App\Http\Middleware\EnsureRole::class);
        $this->app['router']->aliasMiddleware('is_admin', \App\Http\Middleware\EnsureUserIsAdmin::class);
        $this->app['router']->aliasMiddleware('validate.token', \App\Http\Middleware\ValidateToken::class);
    }
}
