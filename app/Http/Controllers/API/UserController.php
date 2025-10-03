<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all users
        $users =User::all();
        return response()->json($users);        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,host,traveler',
        ]);
       
        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'],
        ]);
        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the user by ID
        $user = User::find($id);
        if ($user) {
            return response()->json($user); // Return the user if found
        } else {
            return response()->json(['message' => 'User not found'], 404); // Return a 404 response if user not found
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id); // Find the user by ID
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404); // Return a 404 response if user not found
        }
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id . ',id',
            'password' => 'sometimes|required|string|min:8|confirmed',
            'role' => 'sometimes|required|in:admin,host,traveler',
        ]);

        // Update user fields if they are present in the request
        if (isset($validatedData['name'])) {
            $user->name = $validatedData['name'];
        }
        if (isset($validatedData['email'])) {
            $user->email = $validatedData['email'];
        }
        if (isset($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }
        if (isset($validatedData['role'])) {
            $user->role = $validatedData['role'];
        }
        // Save the updated user
        $user->save();
        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id); // Find the user by ID
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404); // Return a 404 response if user not found
        }
        $user->delete(); // Delete the user
        return response()->json(['message' => 'User deleted successfully']);
    }
}
