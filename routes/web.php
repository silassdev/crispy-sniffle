<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureRole;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Trainer\DashboardController as TrainerDashboard;
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Auth\TrainerRegisterController;
use App\Http\Controllers\TrainerPendingController;


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

// Password routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
     ->name('password.reset'); 
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('password/token-invalid', function(){
    return view('auth.passwords.token-expired');
})->name('password.token.invalid');




// Public admin auth (login/register/logout)
Route::post('/admin/login', [AuthController::class,'login'])->name('admin.login');
Route::post('/admin/register', [AuthController::class,'register'])->name('admin.register');
Route::post('/admin/logout', [AuthController::class,'logout'])->name('admin.logout')->middleware('auth');

// Admin routes — grouped, named, and protected
Route::middleware(['auth', \App\Http\Middleware\EnsureUserIsAdmin::class])
    ->prefix('admin')
    ->group(function () {
        Route::get('dashboard', [AdminDashboard::class,'index'])->name('admin.dashboard');
    });

Route::middleware(['auth', \App\Http\Middleware\EnsureRole::class . ':trainer'])
    ->prefix('trainer')
    ->group(function () {
        Route::get('dashboard', [TrainerDashboard::class,'index'])->name('trainer.dashboard');
    });

Route::middleware(['auth', \App\Http\Middleware\EnsureRole::class . ':student'])
    ->prefix('student')
    ->group(function () {
        Route::get('dashboard', [StudentDashboard::class,'index'])->name('student.dashboard');
    });

Route::get('/trainer/pending', [TrainerPendingController::class, 'index'])
    ->name('trainer.pending');

// Invite accept (public link)
Route::get('admin/invite/accept/{token}', function ($token){
    return view('admin.invites.accept', ['token' => $token]);
})->name('admin.invite.accept');

