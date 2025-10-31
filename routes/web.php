<?php

if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\AuthController;


// temporary minimal auth route stubs
Route::get('/register', function () {
    // quick fallback view or redirect to home
    return view('auth.register'); // create a simple view or change to `redirect()->route('home')`
})->name('register');

Route::get('/login', function () {
    return view('auth.login'); // or redirect()->route('home')
})->name('login');



Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('password/token-invalid', function(){
    return view('auth.passwords.token-expired');
})->name('password.token.invalid');


Route::post('/admin/login', [AuthController::class,'login'])->name('admin.login');
Route::post('/admin/register', [AuthController::class,'register'])->name('admin.register');
Route::post('/admin/logout', [AuthController::class,'logout'])->name('admin.logout')->middleware('auth');


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blogs.show');

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

use App\Http\Controllers\Auth\SocialAuthController;

// redirect: /auth/redirect/{provider}
Route::get('auth/redirect/{provider}', [SocialAuthController::class, 'redirectToProvider'])
    ->name('social.redirect')
    ->where('provider', 'google|github|facebook');

// callback: /auth/callback/{provider}
Route::get('auth/callback/{provider}', [SocialAuthController::class, 'handleProviderCallback'])
    ->name('social.callback')
    ->where('provider', 'google|github|facebook');



# Admin routes (protect with auth)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
});
