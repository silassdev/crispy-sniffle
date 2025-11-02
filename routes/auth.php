<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Auth\SocialLinkController;
use App\Http\Controllers\Admin\AdminInviteController;

/*
|--------------------------------------------------------------------------
| Authentication & Social Routes
|--------------------------------------------------------------------------
|
| All auth-related routes are defined here. Keep admin-only auth in a
| separate admin file if you want, but avoid duplicate names/URIs.
|
*/

// Public guest routes
Route::middleware('guest')->group(function () {
    // Registration
    Route::get('register', function(){ return view('auth.register'); })->name('register');
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register.submit');

    // Login
    Route::get('login', function(){ return view('auth.login'); })->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.submit');

    // Password reset (request)
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    // Password reset (form via token)
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');

    // Admin invite accept (invited admin uses this to set password)
    Route::get('admin/invite/{token}', [AdminInviteController::class, 'showAcceptForm'])->name('admin.invite.accept');
    Route::post('admin/invite/accept', [AdminInviteController::class, 'accept'])->name('admin.invite.accept.submit');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Logout (POST)
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Social link/unlink for logged-in users
    Route::get('auth/link/{provider}', [SocialLinkController::class, 'redirect'])->name('social.link')
        ->where('provider', 'google|github|facebook');
    Route::get('auth/link/callback/{provider}', [SocialLinkController::class, 'callback'])->name('social.link.callback')
        ->where('provider', 'google|github|facebook');
    Route::post('auth/link/unlink', [SocialLinkController::class, 'unlink'])->name('social.link.unlink');

    // Admin-only invite sender
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('invite', [AdminInviteController::class, 'create'])->name('invite.form');
        Route::post('invite', [AdminInviteController::class, 'store'])->name('invite.send');
    });
});

// Social auth redirect & callback (guest or stateful)
Route::get('auth/redirect/{provider}', [SocialAuthController::class, 'redirectToProvider'])
    ->name('social.redirect')
    ->where('provider', 'google|github|facebook');

Route::get('auth/callback/{provider}', [SocialAuthController::class, 'handleProviderCallback'])
    ->name('social.callback')
    ->where('provider', 'google|github|facebook');
