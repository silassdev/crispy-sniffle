<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\TrainerController;
use App\Http\Controllers\Dashboard\StudentController;
use App\Http\Controllers\Admin\TrainerApprovalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\Trainer\CourseController as TrainerCourseController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

require __DIR__.'/auth.php';

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('courses', CourseController::class);
    Route::get('community', [CommunityController::class, 'index']);
});

// Student dashboard
Route::middleware(['auth','verified','role:student,trainer,admin'])->group(function () {
    Route::get('/dashboard/student', [StudentController::class,'index'])->name('student.dashboard');
});

// Trainer routes
Route::get('/trainer/pending', function () {
    return view('auth.trainer_pending');
})->name('trainer.pending');

Route::middleware(['auth','role:trainer','approved.trainer'])->group(function () {
    Route::get('/dashboard/trainer', [TrainerController::class, 'index'])->name('trainer.dashboard');
    Route::resource('trainer/courses', TrainerCourseController::class)->names('trainer.courses');
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth','role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/trainers', [TrainerApprovalController::class,'index'])->name('trainers.index');
    Route::get('/trainers/pending', [TrainerApprovalController::class, 'index'])->name('trainers.pending');
    Route::post('/trainers/{user}/approve', [TrainerApprovalController::class, 'approve'])->name('trainers.approve');
});
