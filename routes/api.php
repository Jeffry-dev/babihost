<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController; // Import the AuthController
use App\Http\Controllers\API\UserController; // Import the UserController
use App\Http\Controllers\API\HostController; // Import the HostController
use App\Http\Controllers\API\PropertyController; // Import the PropertyController
use App\Http\Controllers\API\RoomController; // Import the RoomController
use App\Http\Controllers\API\BookingController; // Import the BookingController
use App\Http\Controllers\API\PaymentController; // Import the PaymentController

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

// Property routes
Route::get('/properties', [PropertyController::class, 'index']);
Route::post('/properties', [PropertyController::class, 'store']);
Route::get('/properties/{id}', [PropertyController::class, 'show']);
Route::put('/properties/{id}', [PropertyController::class, 'update']);
Route::delete('/properties/{id}', [PropertyController::class, 'destroy']);

// Room routes
Route::get('/rooms', [RoomController::class, 'index']);
Route::post('/rooms', [RoomController::class, 'store']);
Route::get('/rooms/{id}', [RoomController::class, 'show']);
Route::put('/rooms/{id}', [RoomController::class, 'update']);
Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);

// Booking routes
Route::get('/bookings',[BookingController::class, 'index']);
Route::post('/bookings',[BookingController::class,'store']);
Route::get('/bookings/{id}',[BookingController::class,'show']);
Route::put('/bookings/{id}',[BookingController::class,'update']);
Route::delete('/bookings/{id}',[BookingController::class,'destroy']);

// Payment routes
Route::get('/payments', [PaymentController::class, 'index']);
Route::post('/payments',[PaymentController::class, 'store']);
Route::get('/payments/{id}', [PaymentController::class, 'show']);
Route::put('/payments/{id}', [PaymentController::class, 'update']);
Route::delete('/payments/{id}', [PaymentController::class, 'destroy']);

