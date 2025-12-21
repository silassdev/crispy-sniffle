<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Trainer\DashboardController;


Route::middleware(['auth', 'role:trainer'])
    ->prefix('trainer')
    ->name('trainer.')
    ->group(function () {
        
        // Dashboard / Overview
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Assignment Management
        Route::get('/assignment', fn() => view('trainer.assignment.index'))->name('assignment');
        Route::get('/assignment/{id}', fn($id) => view('trainer.assignment.show', compact('id')))->name('assignment.show');
        
        // Scores / Grading
        Route::get('/scores', fn() => view('trainer.scores.index'))->name('scores');
        Route::get('/scores/{studentId}', fn($studentId) => view('trainer.scores.show', compact('studentId')))->name('scores.show');
        
        // Course Management
        Route::get('/courses', [DashboardController::class, 'courses'])->name('courses.index');
        Route::get('/courses/{id}', [TrainerCourseController::class,'show'])->name('courses.show'); 
        
        // Students under this trainer
        Route::get('/students', fn() => view('trainer.students.index'))->name('students');
        Route::get('/students/{id}', fn($id) => view('trainer.students.show', compact('id')))->name('students.show');
        
        // Community
        Route::get('/community', fn() => view('trainer.community'))->name('community');
        Route::get('/posts', fn() => view('trainer.posts'))->name('posts');
    });
