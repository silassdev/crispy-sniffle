<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Middleware\EnsureUserIsAdmin;

// Load auth routes if present
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}

// Home (single declaration)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Blog + contact
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blogs.show');

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Password routes (ensure you DON'T duplicate these elsewhere)
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
     ->name('password.reset'); // keep only one definition of this route
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('password/token-invalid', function(){
    return view('auth.passwords.token-expired');
})->name('password.token.invalid');

// Public admin auth (login/register/logout)
Route::post('/admin/login', [AuthController::class,'login'])->name('admin.login');
Route::post('/admin/register', [AuthController::class,'register'])->name('admin.register');
Route::post('/admin/logout', [AuthController::class,'logout'])->name('admin.logout')->middleware('auth');

// Admin routes — grouped, named, and protected
Route::prefix('admin')
     ->name('admin.')
     ->middleware(['auth', EnsureUserIsAdmin::class])
     ->group(function () {
         Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
         // add other admin routes here, e.g. Route::resource('users', AdminUserController::class)->names('users');
     });

// Invite accept (public link)
Route::get('admin/invite/accept/{token}', function ($token){
    return view('admin.invites.accept', ['token' => $token]);
})->name('admin.invite.accept');

// Authenticated user dashboards
Route::middleware(['auth'])->group(function () {
    Route::view('/student/dashboard', 'dashboards.student')->name('student.dashboard');
    Route::view('/trainer/dashboard', 'dashboards.trainer')->name('trainer.dashboard');
    Route::get('/trainer/pending', function () {
        return view('trainer.pending');
    })->name('trainer.pending');
});
