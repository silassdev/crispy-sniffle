<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CourseApiController;
use App\Http\Controllers\Api\V1\CommunityApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Keep these versioned and auth-protected for mobile apps (use Sanctum).
|
*/

Route::prefix('v1')->group(function () {
    // Auth endpoints (login/register for mobile — use Sanctum)
    Route::post('auth/login', [AuthController::class, 'login']);
    Route::post('auth/register', [AuthController::class, 'register']);

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('auth/logout', [AuthController::class, 'logout']);

        // Courses & lessons
        Route::apiResource('courses', CourseApiController::class)->only(['index','show']);

        // Community posts
        Route::apiResource('community', CommunityApiController::class)->except(['create','edit']);
    });
});
