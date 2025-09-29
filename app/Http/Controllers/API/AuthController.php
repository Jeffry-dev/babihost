<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Registration method will be implemented here
    public function register(Request $request)
    {
        
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,host,traveler',
        ]);
       
        // Create the user
        $user = \App\Models\User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'],
        ]);
        // Create a token for the user   
        $token = $user->createToken('token')->plainTextToken;
 
        // Return a response
        return response()->json(['message' => 'User registerd successfully',
        'user' => $user,
        'token' => $token
        ],201);
    }
}
