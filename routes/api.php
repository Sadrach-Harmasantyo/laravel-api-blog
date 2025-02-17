<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware(['api_key'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{id}', [PostController::class, 'show']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
});
