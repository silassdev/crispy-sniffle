<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TrainerController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\CertificateController as AdminCertificateController;




        Route::middleware(['auth', 'role:admin'])
        ->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Counters endpoint for AJAX dashboard widgets
        Route::get('/counters', [DashboardController::class, 'counters'])->name('counters');

        Route::get('students', [\App\Http\Controllers\Admin\StudentController::class, 'index'])->name('students.index');
        Route::get('students/{id}', [\App\Http\Controllers\Admin\StudentController::class, 'show'])->name('students.show');

        Route::get('/trainers', [\App\Http\Controllers\Admin\TrainerController::class, 'index'])->name('trainers.index');
        Route::get('/trainers/{id}', [\App\Http\Controllers\Admin\TrainerController::class, 'show'])->name('trainers.show');
        Route::post('/trainers/{id}/approve', [\App\Http\Controllers\Admin\TrainerController::class, 'approve'])->name('trainers.approve');
        Route::delete('/trainers/{id}', [\App\Http\Controllers\Admin\TrainerController::class, 'destroy'])->name('trainers.destroy');


        Route::get('/admins', [AdminUserController::class, 'index'])->name('admins');
        Route::get('/admins/{id}', [AdminUserController::class, 'show'])->name('admins.show');

        Route::get('/community', [\App\Http\Controllers\Admin\AdminUIController::class, 'community'])->name('community');
        
        // post management
        Route::get('/posts', [AdminPostController::class, 'index'])->name('posts');
        Route::get('/posts/create', [AdminPostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [AdminPostController::class, 'store'])->name('posts.store');
        Route::get('/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [AdminPostController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{post}', [AdminPostController::class, 'destroy'])->name('posts.destroy');
        Route::get('/posts/{post}', [AdminPostController::class, 'show'])->name('posts.show');



        Route::get('/newsletter', [\App\Http\Controllers\Admin\AdminUIController::class, 'newsletter'])->name('newsletter');
        Route::get('/feedback', [\App\Http\Controllers\Admin\FeedbackController::class, 'index'])->name('feedback.index');
        Route::delete('/feedback/{feedback}', [\App\Http\Controllers\Admin\FeedbackController::class, 'destroy'])->name('feedback.destroy');
        
        Route::get('/jobs', [\App\Http\Controllers\Admin\AdminUIController::class, 'jobs'])->name('jobs');


        //  courses View & Export
        Route::get('/courses/{course}', [AdminCourseController::class, 'show'])->name('courses.show');
        Route::get('/courses/{course}/view', [\App\Http\Controllers\Admin\CourseController::class,'show'])->name('courses.show');
        Route::get('/courses/{course}/export-csv', [AdminCourseController::class, 'exportCsv'])->name('courses.export.csv');
        Route::get('/courses/{course}/export-students-csv', [AdminCourseController::class, 'exportStudentsCsv'])->name('courses.export.students_csv');
        Route::get('/courses/{course}/export-chapters-pdf', [AdminCourseController::class, 'exportChaptersPdf'])->name('courses.export.chapters_pdf');

        // Certifiication
        Route::get('/certificates', [AdminCertificateController::class,'index'])->name('certificates.index');
        Route::post('/certificates/{id}/approve', [AdminCertificateController::class,'approve'])->name('certificates.approve');
        Route::post('/certificates/{id}/reject', [AdminCertificateController::class,'reject'])->name('certificates.reject');
        Route::post('/certificates/{id}/revoke', [AdminCertificateController::class,'revoke'])->name('certificates.revoke');
});



        

