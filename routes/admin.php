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
use App\Http\Controllers\Admin\PostController as AdminPostController;




        Route::middleware(['auth', 'role:admin', 'fragment.redirect'])
        ->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Counters endpoint for AJAX or dashboard widgets
        Route::get('/counters', [DashboardController::class, 'counters'])->name('counters');

        Route::get('students', [\App\Http\Controllers\Admin\StudentController::class, 'index'])->name('students.index');
        Route::get('students/{id}', [\App\Http\Controllers\Admin\StudentController::class, 'show'])->name('students.show');


        Route::get('/trainers', [\App\Http\Controllers\Admin\TrainerController::class, 'index'])->name('trainers.index');
        Route::get('/trainers/{id}', [\App\Http\Controllers\Admin\TrainerController::class, 'show'])->name('trainers.show');
        Route::post('/trainers/{id}/approve', [\App\Http\Controllers\Admin\TrainerController::class, 'approve'])->name('trainers.approve');
        Route::delete('/trainers/{id}', [\App\Http\Controllers\Admin\TrainerController::class, 'destroy'])->name('trainers.destroy');


        Route::get('/admins', [AdminUserController::class, 'index'])->name('admins');
        Route::get('/admins/{id}', [AdminUserController::class, 'show'])->name('admins.show');

        Route::get('/community', [CommunityController::class, 'index'])->name('community');

        Route::get('/comments', [CommentController::class, 'index'])->name('comments');

        // Admin post management (create/draft/publish)
        Route::get('/posts', [AdminPostController::class, 'index'])->name('posts');
        Route::get('/posts/create', [AdminPostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [AdminPostController::class, 'store'])->name('posts.store');
        Route::get('/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [AdminPostController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{post}', [AdminPostController::class, 'destroy'])->name('posts.destroy');
        Route::get('/posts/{post}', [AdminPostController::class, 'show'])->name('posts.show');



        Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');

        Route::get('/other-actions', [OtherActionsController::class, 'index'])->name('other-actions');

        Route::view('/courses', 'admin.courses')->name('courses');
        Route::view('/newsletter', 'admin.newsletter')->name('newsletter');

});



        

