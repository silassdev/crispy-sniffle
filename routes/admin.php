<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TrainerController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CommunityController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\OtherActionsController;

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Counters endpoint for AJAX or dashboard widgets
        Route::get('/counters', [DashboardController::class, 'counters'])->name('counters');

        Route::get('/students', [StudentController::class, 'index'])->name('students');

        Route::get('/trainers', [TrainerController::class, 'index'])->name('trainers');

        Route::get('/admins', [AdminUserController::class, 'index'])->name('admins');
        Route::get('/admins/{id}', [AdminUserController::class, 'show'])->name('admins.show');

        Route::get('/community', [CommunityController::class, 'index'])->name('community');

        Route::get('/comments', [CommentController::class, 'index'])->name('comments');

        Route::get('/posts', [PostController::class, 'index'])->name('posts');

        Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');

        Route::get('/other-actions', [OtherActionsController::class, 'index'])->name('other-actions');
    });
