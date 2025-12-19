<?php

use Illuminate\Support\Facades\Route;

if (file_exists(__DIR__ . '/auth.php')) {
    require __DIR__ . '/auth.php';
}

if (file_exists(__DIR__ . '/admin.php')) {
    require __DIR__ . '/admin.php';
}

// Public controllers
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Admin controllers
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ViewAsController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TrainerController;
use App\Http\Controllers\Admin\AdminController;

// Trainer & Student dashboards
use App\Http\Controllers\Trainer\DashboardController as TrainerDashboardController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\CourseController;





/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/contribution', [HomeController::class, 'contribution'])->name('contribution');

Route::fallback(fn () => response()->view('errors.404', [], 404));

//Post Routes


// Blog
Route::get('/blogs', [PostController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [PostController::class, 'show'])->name('blogs.show');

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
| Admin Auth + Protected Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth (public)
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

    // Invite accept (public)
    Route::get('invite/accept/{token}', fn (string $token) => view('admin.invites.accept', ['token' => $token]))
        ->name('invite.accept');

    // Protected admin routes
    Route::middleware(['auth', \App\Http\Middleware\EnsureUserIsAdmin::class])->group(function () {
        // Dashboard (named admin.dashboard)
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Trainer management
        Route::get('trainers', [TrainerController::class, 'index'])->name('trainers.index');
        Route::get('trainers/{id}', [TrainerController::class, 'show'])->name('trainers.show');
        Route::get('trainers/{id}/edit', [TrainerController::class, 'edit'])->name('trainers.edit');

        // Student management
        Route::get('students', [StudentController::class, 'index'])->name('students.index');
        Route::get('students/{id}', [StudentController::class, 'show'])->name('students.show');
        Route::get('students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');

        // Admins management
        Route::get('admins', [AdminController::class, 'index'])->name('admins.index');
        Route::get('admins/{id}', [AdminController::class, 'show'])->name('admins.show');
        Route::get('admins/{id}/edit', [AdminController::class, 'edit'])->name('admins.edit');

        // Simple views
        Route::view('community', 'admin.community')->name('community');
        Route::view('comments', 'admin.comments')->name('comments');
        Route::view('posts', 'admin.posts')->name('posts');
        Route::view('feedback', 'admin.feedback')->name('feedback');
        Route::view('other-actions', 'admin.other-actions')->name('other-actions');
    });
});

// Admin “view as” (keep middleware consistent; using EnsureUserIsAdmin if you have it)
Route::post('admin/view-as', [ViewAsController::class, 'set'])
    ->middleware(['auth', \App\Http\Middleware\EnsureUserIsAdmin::class])
    ->name('admin.view-as');

Route::post('admin/view-as/clear', [ViewAsController::class, 'clear'])
    ->middleware(['auth', \App\Http\Middleware\EnsureUserIsAdmin::class])
    ->name('admin.view-as.clear');

/*
|--------------------------------------------------------------------------
| Trainer Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:trainer'])->prefix('trainer')->name('trainer.')->group(function(){

    Route::get('dashboard', [\App\Http\Controllers\Trainer\DashboardController::class, 'index'])->name('dashboard');
    
    Route::view('community', 'trainer.community')->name('community');
    Route::view('posts', 'trainer.posts')->name('posts');
});


// Pending trainer (fix your middleware name if it’s custom)
Route::get('trainer/pending', fn () => view('trainer.pending', [
    'email' => session('trainer_email'),
]))->middleware('pending-trainer')->name('trainer.pending');

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:student'])->prefix('student')->name('student.')->group(function() {
    Route::get('dashboard', [\App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');
            Route::resource('courses', CourseController::class);

});
