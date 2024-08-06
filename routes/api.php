<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('users/{user}', [UserController::class, 'userProfile']);
    Route::put('users/{user}', [UserController::class, 'update']);
    Route::post('users/{user}/follow', [UserController::class, 'follow']);
    Route::post('users/{user}/unfollow', [UserController::class, 'unfollow']);
    Route::get('users/{user}/followers', [UserController::class, 'followers']);
    Route::get('users/{user}/following', [UserController::class, 'following']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('post', PostController::class);
});
