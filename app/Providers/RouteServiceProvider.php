<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureRole;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\ValidateToken;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // call parent boot to let Laravel register its default route logic
        parent::boot();

        // Register middleware aliases
        $this->app['router']->aliasMiddleware('role', EnsureRole::class);
        $this->app['router']->aliasMiddleware('is_admin', EnsureUserIsAdmin::class);
        $this->app['router']->aliasMiddleware('validate.token', ValidateToken::class);
    }
}
