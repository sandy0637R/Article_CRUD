<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::apiResource('users', UserController::class);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// ->middleware('auth:sanctum');
Route::apiResource('articles', ArticleController::class)
    ->only(['index', 'show']);

// Protected
    Route::middleware(['auth:sanctum','admin'])->group(function () {
    Route::apiResource('articles', ArticleController::class)
        ->only(['store', 'update', 'destroy']);
});