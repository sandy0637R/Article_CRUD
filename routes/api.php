<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\ArticleController;
Route::get('/user', function () {
    return User::all();
});
// ->middleware('auth:sanctum');
Route::resource('articles', ArticleController::class);
