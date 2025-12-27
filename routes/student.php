<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\CourseController;



Route::middleware(['auth', 'role:student']) ->prefix('student') ->name('student.') ->group(function () {
        
        // Dashboard / Overview
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Courses
        Route::resource('courses', CourseController::class);
        Route::get('/courses/{course}/chapters/{order}', [\App\Http\Controllers\Student\ChapterController::class,'showByOrder'])->name('chapters.show');
        Route::post('/chapters/{chapter}/complete', [\App\Http\Controllers\Student\ChapterController::class,'markComplete'])->name('chapters.complete');
        
        // Scores / Grades
        Route::get('/scores', fn() => view('student.scores.index'))->name('scores');
        Route::get('/scores/{courseId}', fn($courseId) => view('student.scores.show', compact('courseId')))->name('scores.show');
        
        // Community
        Route::get('/community', fn() => view('student.community'))->name('community');
        
        // Assignments
        Route::get('/student/assessments', function () {    return view('student.assessments.index'); })->name('student.assessments');
        Route::get('/assignment/{id}', fn($id) => view('student.assignment.show', compact('id')))->name('assignment.show');
        Route::post('/assignment/{id}/submit', fn($id) => redirect()->back()->with('success', 'Assignment submitted!'))->name('assignment.submit');
    });
