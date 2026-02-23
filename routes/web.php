<?php

use Illuminate\Support\Facades\Route;

if (file_exists(__DIR__ . '/auth.php')) {
    require __DIR__ . '/auth.php';
}

if (file_exists(__DIR__ . '/admin.php')) {
    require __DIR__ . '/admin.php';
}

if (file_exists(__DIR__ . '/trainer.php')) {
    require __DIR__ . '/trainer.php';
}

if (file_exists(__DIR__ . '/student.php')) {
    require __DIR__ . '/student.php';
}

// Public controllers
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseEnrollmentController;
use App\Http\Controllers\CertificateController;


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

//Notification
use App\Http\Controllers\NotificationsController;

// Certificate 
use App\Http\Controllers\CertificatePdfController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/contribution', [HomeController::class, 'contribution'])->name('contribution');

//Subscribe & feedback
Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::post('/feedback', [FeedbackController::class, 'submit'])->name('feedback.submit');

//Notification public
Route::get('/notifications/unread', [NotificationsController::class, 'unread'])->name('notifications.unread')->middleware('auth');
Route::post('/notifications/mark-read', [NotificationsController::class, 'markRead'])->name('notifications.markRead')->middleware('auth');
Route::get('/notifications', function () { return view('notifications.index'); })->name('notifications.index')->middleware('auth');
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy')->middleware('auth');

// Careers / Jobs / Sponsor & Feedback
Route::get('/careers', [JobController::class, 'index'])->name('careers.index');
Route::get('/careers/{slug}', [JobController::class, 'show'])->name('careers.show');

Route::get('/sponsor', function () { return view('sponsor'); })->name('sponsor');
Route::get('/feedback', function () { return view('feedback'); })->name('feedback');


// Courses
Route::get('/courses', [CourseController::class,'index'])->name('courses.index');
Route::get('/courses/{slug}', [CourseController::class,'show'])->name('courses.show');

Route::fallback(fn () => response()->view('errors.404', [], 404));

// Pending trainer
Route::get('trainer/pending', fn () => view('trainer.pending', [ 'email' => session('trainer_email'), ]))->middleware('pending-trainer')->name('trainer.pending');

// Invite accept
Route::get('invite/accept/{token}', fn (string $token) => view('admin.invites.accept', ['token' => $token])) ->name('invite.accept');

// Blog
Route::get('/blogs', [PostController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [PostController::class, 'show'])->name('blogs.show');

// Contact
Route::controller(ContactController::class)->group(function () { Route::get('/contact', 'show')->name('contact.show');
    Route::post('/contact', 'submit')->name('contact.submit');
});

// enroll for authenticated users
Route::post('/courses/{id}/enroll', [CourseEnrollmentController::class,'enroll']) ->name('courses.enroll')->middleware('auth');

// Password reset
Route::prefix('password')->group(function () {
    Route::get('reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('token-invalid', fn () => view('auth.passwords.token-expired'))->name('password.token.invalid');
});

// Certificates & PDF routes
Route::get('/certificate/{number}', [CertificateController::class, 'publicShow'])->name('certificate.public');
Route::get('/verify/{certificate_number}', [CertificateController::class, 'publicShow'])->name('certificate.verify');
Route::get('/certificates/{certificate}/pdf/download', [CertificatePdfController::class, 'download'])
    ->name('certificates.pdf.download');

// Public PDF routes for approved certificates
Route::get('/certificates/{id}/pdf', [CertificatePdfController::class, 'preview'])->name('certificates.pdf.preview');
Route::get('/certificates/{id}/download', [CertificatePdfController::class, 'download']);

Route::middleware(['auth'])->group(function () {
    Route::post('/certificates/{id}/save', [CertificatePdfController::class, 'saveToStorage'])->name('certificates.pdf.save');
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

    // student result (viewable by owner, trainer, admin)
    Route::get('quiz-attempts/{id}/result', [\App\Http\Controllers\Student\QuizController::class,'result'])
        ->name('student.quiz.result');

    // Protected admin routes
    Route::middleware(['auth', \App\Http\Middleware\EnsureUserIsAdmin::class])->group(function () {

        // Dashboard 
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

    });
});