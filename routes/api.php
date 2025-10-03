<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController; // Import the AuthController
use App\Http\Controllers\API\UserController; // Import the UserController
use App\Http\Controllers\API\HostController; // Import the HostController


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']); // Registration route
Route::post('/login', [AuthController::class, 'login']); // Login route
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); // Logout route

// User routes
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

// Host routes
Route::get('/hosts', [HostController::class, 'index']);
Route::post('/hosts', [HostController::class, 'store']);
Route::get('/hosts/{id}', [HostController::class, 'show']);
Route::put('/hosts/{id}', [HostController::class, 'update']);
Route::delete('/hosts/{id}', [HostController::class, 'destroy']);