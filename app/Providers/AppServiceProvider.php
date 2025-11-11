<?php

namespace App\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }
    public function boot(): void
    {
        
    if (class_exists(\App\Http\Livewire\Forms\LoginForm::class)) {
    Livewire::component('forms.login-form', \App\Http\Livewire\Forms\LoginForm::class);
}
       if (class_exists(\App\Http\Livewire\Forms\RegisterForm::class)) {
    Livewire::component('forms.register-form', \App\Http\Livewire\Forms\RegisterForm::class);
}   
       if (class_exists(\App\Http\Livewire\Actions\Logout::class)) {
        Livewire::component('actions.logout', \App\Http\Livewire\Actions\Logout::class);
       }
    }
}
