<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\AdminInviteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialLinkController;
use App\Http\Controllers\Dashboard\TrainerController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\StudentController;


Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create']) ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create']) ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store']) ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create']) ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store']) ->name('password.store');

    Route::get('admin/invite/{token}', [AdminInviteController::class, 'showAcceptForm'])->name('admin.invite.accept');
    Route::post('admin/invite/accept', [AdminInviteController::class, 'accept'])->name('admin.invite.accept.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class) ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1']) ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy']) ->name('logout');

    Route::get('/dashboard/student', [StudentController::class, 'index'])->name('student.dashboard');

    Route::get('/dashboard/trainer', [TrainerController::class, 'index'])->name('trainer.dashboard');

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');




    // Link redirect and callback
    Route::get('auth/link/{provider}', [SocialLinkController::class, 'redirect'])
        ->name('social.link')
        ->where('provider', 'google|github');

    Route::get('auth/link/callback/{provider}', [SocialLinkController::class, 'callback'])
        ->name('social.link.callback')
        ->where('provider', 'google|github');

    // Unlink (POST)
    Route::post('auth/link/unlink', [SocialLinkController::class, 'unlink'])
        ->name('social.link.unlink');



    // Admin: invite another admin (only 'admin' role; protect with role middleware)
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('invite', [AdminInviteController::class, 'create'])->name('invite.form'); 
        Route::post('invite', [AdminInviteController::class, 'store'])->name('invite.send'); 
        // Admin can also request reset for other admin users via normal password reset flow or added endpoints.
    // link provider (redirect) - for logged in users
Route::get('auth/link/{provider}', [\App\Http\Controllers\Auth\SocialLinkController::class, 'redirect'])->middleware('auth')->name('social.link');
Route::get('auth/link/callback/{provider}', [\App\Http\Controllers\Auth\SocialLinkController::class, 'callback'])->middleware('auth')->name('social.link.callback');

});
});