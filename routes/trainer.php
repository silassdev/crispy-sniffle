<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Trainer\DashboardController;
use App\Http\Controllers\AssessmentSubmissionController;
use App\Http\Controllers\Trainer\CertificateController as TrainerCertificateController;
use App\Http\Controllers\Trainer\CourseController as TrainerCourseController;
use App\Livewire\Trainer\Quizzes\Index as TrainerQuizzesIndex;
use App\Livewire\Trainer\Quizzes\Builder as TrainerQuizzesBuilder;




Route::middleware(['auth', 'role:trainer']) ->prefix('trainer') ->name('trainer.') ->group(function () {
        
        // Dashboard / Overview
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Scores / Grading
        Route::get('/scores', [\App\Http\Controllers\Trainer\ScoreController::class, 'index'])->name('scores');
        Route::get('/scores/show', [\App\Http\Controllers\Trainer\ScoreController::class, 'show'])->name('scores.show');
        
        // Course Management
        Route::get('/courses', [\App\Http\Controllers\Trainer\CourseController::class, 'index'])->name('courses.index');
        Route::get('/courses/create', [\App\Http\Controllers\Trainer\CourseController::class, 'create'])->name('courses.create');
        Route::post('/courses', [\App\Http\Controllers\Trainer\CourseController::class, 'store'])->name('courses.store');
        Route::get('/courses/{course}', [\App\Http\Controllers\Trainer\CourseController::class, 'show'])->name('courses.show');
        Route::get('/courses/{course}/edit', [\App\Http\Controllers\Trainer\CourseController::class, 'edit'])->name('courses.edit');
        Route::put('/courses/{course}', [\App\Http\Controllers\Trainer\CourseController::class, 'update'])->name('courses.update');
        Route::delete('/courses/{course}', [\App\Http\Controllers\Trainer\CourseController::class, 'destroy'])->name('courses.destroy');
        Route::get('/courses/{course}/quizzes', TrainerQuizzesIndex::class)->name('quizzes.index');
        Route::get('/courses/{course}/quiz/create', TrainerQuizzesBuilder::class)  ->name('quiz.builder');
        Route::get('/courses/{course}/chapters', [\App\Http\Controllers\Trainer\ChapterController::class,'index'])->name('chapters.index');
        Route::post('/courses/{course}/chapters', [\App\Http\Controllers\Trainer\ChapterController::class,'store'])->name('chapters.store');
        Route::put('/courses/{course}/chapters/{chapter}', [\App\Http\Controllers\Trainer\ChapterController::class,'update'])->name('chapters.update');
        Route::delete('/courses/{course}/chapters/{chapter}', [\App\Http\Controllers\Trainer\ChapterController::class,'destroy'])->name('chapters.destroy');

        Route::get('/courses/{course}/assessments', fn($courseId) => view('trainer.assessments.index', ['courseId' => $courseId]))->name('assessments.index');
        Route::get('/assessments/{id}/submissions', fn($id) => view('trainer.assessments.submissions', ['assessmentId'=>$id]))->name('assessments.submissions');
        // Assignment Management
        Route::get('/assignment', [\App\Http\Controllers\Trainer\AssignmentController::class, 'index'])->name('assignment');
        Route::get('/assignment/create', [\App\Http\Controllers\Trainer\AssignmentController::class, 'create'])->name('assignment.create');
        Route::post('/assignment', [\App\Http\Controllers\Trainer\AssignmentController::class, 'store'])->name('assignment.store');
        Route::get('/assignment/{assignment}', [\App\Http\Controllers\Trainer\AssignmentController::class, 'show'])->name('assignment.show');
        Route::get('/assignment/{assignment}/edit', [\App\Http\Controllers\Trainer\AssignmentController::class, 'edit'])->name('assignment.edit');
        Route::put('/assignment/{assignment}', [\App\Http\Controllers\Trainer\AssignmentController::class, 'update'])->name('assignment.update');
        Route::delete('/assignment/{assignment}', [\App\Http\Controllers\Trainer\AssignmentController::class, 'destroy'])->name('assignment.destroy');
        
        
        // Students under this trainer
        Route::get('/students', [\App\Http\Controllers\Trainer\StudentController::class, 'index'])->name('students');
        Route::get('/students/{id}', [\App\Http\Controllers\Trainer\StudentController::class, 'show'])->name('students.show');
        
        // Community
        Route::get('/community', fn() => view('trainer.community'))->name('community');
        Route::get('/posts', fn() => view('trainer.posts'))->name('posts');

        // Certificates
        Route::get('/certificates', [TrainerCertificateController::class,'index'])->name('certificates.index');
        Route::get('/certificates/create', [TrainerCertificateController::class,'create'])->name('certificates.create');
        Route::post('/certificates', [TrainerCertificateController::class,'store'])->name('certificates.store');
        Route::get('/certificates/{id}', [TrainerCertificateController::class,'show'])->name('certificates.show');

        
    });
