<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/jobs',         [JobController::class, 'index']);
    Route::post('/jobs',        [JobController::class, 'store']);
    Route::delete('/jobs/{job}',[JobController::class, 'destroy']);

    Route::post('/jobs/{job}/apply',       [ApplicationController::class, 'store']);
    Route::get('/applications',            [ApplicationController::class, 'index']);
    Route::put('/applications/{application}', [ApplicationController::class, 'update']);
});
