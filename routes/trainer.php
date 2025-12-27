<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Trainer\DashboardController;
use App\Http\Controllers\AssessmentSubmissionController;
use App\Http\Controllers\Trainer\CertificateController as TrainerCertificateController;
use App\Http\Controllers\Trainer\CourseController as TrainerCourseController;




Route::middleware(['auth', 'role:trainer']) ->prefix('trainer') ->name('trainer.') ->group(function () {
        
        // Dashboard / Overview
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Assignment Management
        Route::get('/assignment', fn() => view('trainer.assignment.index'))->name('assignment');
        Route::get('/assignment/{id}', fn($id) => view('trainer.assignment.show', compact('id')))->name('assignment.show');
        
        // Scores / Grading
        Route::get('/scores', fn() => view('trainer.scores.index'))->name('scores');
        Route::get('/scores/{studentId}', fn($studentId) => view('trainer.scores.show', compact('studentId')))->name('scores.show');
        
        // Course Management
        Route::get('/courses', fn()=> view('trainer.courses.index'))->name('courses.index');
        Route::get('/courses/{id}', [TrainerCourseController::class,'show'])->name('courses.show'); 
        
        // Students under this trainer
        Route::get('/students', fn() => view('trainer.students.index'))->name('students');
        Route::get('/students/{id}', fn($id) => view('trainer.students.show', compact('id')))->name('students.show');
        
        // Community
        Route::get('/community', fn() => view('trainer.community'))->name('community');
        Route::get('/posts', fn() => view('trainer.posts'))->name('posts');

        // Certificates
        Route::get('/certificates', [TrainerCertificateController::class,'index'])->name('certificates.index');
        Route::get('/certificates/create', [TrainerCertificateController::class,'create'])->name('certificates.create');
        Route::post('/certificates', [TrainerCertificateController::class,'store'])->name('certificates.store');
        Route::get('/certificates/{id}', [TrainerCertificateController::class,'show'])->name('certificates.show');

        //Courses
        Route::get('/courses/{course}/chapters', [\App\Http\Controllers\Trainer\ChapterController::class,'index'])->name('chapters.index');
        Route::post('/courses/{course}/chapters', [\App\Http\Controllers\Trainer\ChapterController::class,'store'])->name('chapters.store');
        Route::put('/courses/{course}/chapters/{chapter}', [\App\Http\Controllers\Trainer\ChapterController::class,'update'])->name('chapters.update');
        Route::delete('/courses/{course}/chapters/{chapter}', [\App\Http\Controllers\Trainer\ChapterController::class,'destroy'])->name('chapters.destroy');

        //Assessment
        Route::get('/courses/{course}/assessments', fn($courseId) => view('trainer.assessments.index', ['courseId' => $courseId]))->name('assessments.index');
        Route::get('/assessments/{id}/submissions', fn($id) => view('trainer.assessments.submissions', ['assessmentId'=>$id]))->name('assessments.submissions');
    });
