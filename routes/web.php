<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\TrainerController;
use App\Http\Controllers\Trainer\DashboardController as TrainerDashboard;
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Admin\ViewAsController;


if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::fallback(fn () => response()->view('errors.404', [], 404));

// Blog
Route::prefix('blogs')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('{slug}', [BlogController::class, 'show'])->name('blogs.show');
});

// Contact
Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'show')->name('contact.show');
    Route::post('/contact', 'submit')->name('contact.submit');
});

// Password reset
Route::prefix('password')->group(function () {
    Route::get('reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('token-invalid', fn () => view('auth.passwords.token-expired'))->name('password.token.invalid');
});

/*
|--------------------------------------------------------------------------
| Admin Auth Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('register', [AuthController::class, 'register'])->name('admin.register');
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('admin.logout');

    // Protected admin routes
    Route::middleware(['auth', \App\Http\Middleware\EnsureUserIsAdmin::class])->group(function () {
        Route::get('dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');

        // Trainer management
        Route::get('trainers/{id}', [TrainerController::class, 'show'])->name('admin.trainer.view');
        Route::get('trainers/{id}/edit', [TrainerController::class, 'edit'])->name('admin.trainer.edit');
    });

    // Invite accept (public)
    Route::get('invite/accept/{token}', fn ($token) => view('admin.invites.accept', ['token' => $token]))
        ->name('admin.invite.accept');
});


Route::post('admin/view-as', [ViewAsController::class, 'set'])->name('admin.view-as')->middleware(['auth','is_admin']);
Route::post('admin/view-as/clear', [ViewAsController::class, 'clear'])->name('admin.view-as.clear')->middleware(['auth','is_admin']);


/*
|--------------------------------------------------------------------------
| Trainer Routes
|--------------------------------------------------------------------------
*/
Route::prefix('trainer')->middleware(['auth', \App\Http\Middleware\EnsureRole::class . ':trainer'])->group(function () {
    Route::get('dashboard', [TrainerDashboard::class, 'index'])->name('trainer.dashboard');
});

Route::middleware(['auth','is_admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('trainers', [\App\Http\Controllers\Admin\TrainerController::class,'index'])->name('trainers');
    Route::get('trainers/{id}', [\App\Http\Controllers\Admin\TrainerController::class,'show'])->name('trainer.view');

    Route::get('trainers/{id}/edit', function($id){
        return view('admin.trainers.edit', ['id' => $id]);
    })->name('trainer.edit');
});


Route::get('/trainer/pending', fn () => view('trainer.pending', [
    'email' => session('trainer_email'),
]))->middleware('pending-')->name('trainer.pending');

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/
Route::prefix('student')->middleware(['auth', \App\Http\Middleware\EnsureRole::class . ':student'])->group(function () {
    Route::get('dashboard', [StudentDashboard::class, 'index'])->name('student.dashboard');
});
