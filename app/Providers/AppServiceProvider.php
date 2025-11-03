<?php

namespace App\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // register Livewire components explicitly to avoid discovery issues
    if (class_exists(\App\Http\Livewire\Forms\LoginForm::class)) {
    Livewire::component('forms.login-form', \App\Http\Livewire\Forms\LoginForm::class);
}
       if (class_exists(\App\Http\Livewire\Forms\RegisterForm::class)) {
    Livewire::component('forms.register-form', \App\Http\Livewire\Forms\RegisterForm::class);
}

    }
}
