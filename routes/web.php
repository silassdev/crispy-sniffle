<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function(){
  Route::get('/dashboard', [DashboardController::class, 'index']);
  Route::resource('courses', CourseController::class);
  Route::get('community', [CommunityController::class, 'index']);
});

Route::middleware(['auth','role:admin'])->prefix('admin')->group(function(){
  Route::get('trainers', [TrainerApprovalController::class,'index']);
  Route::post('trainers/{id}/approve', [TrainerApprovalController::class,'approve']);
});
