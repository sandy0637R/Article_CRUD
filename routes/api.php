<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;

Route::get('/user', function () {
    return User::all();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// ->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function () {

    Route::resource('articles', ArticleController::class);

});