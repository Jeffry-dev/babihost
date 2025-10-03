<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController; // Import the AuthController

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']); // Registration route
Route::post('/login', [AuthController::class, 'login']); // Login route
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); // Logout route
