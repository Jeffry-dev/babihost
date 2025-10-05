<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all favorites
        $favorites = Favorite::all();
        return response()->json($favorites);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
        ]);

        // Create the favorite
        $favorite = Favorite::create($validatedData);
        return response()->json(['message' => 'Favorite created successfully', 
        'favorite' => $favorite
    ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the favorite by ID
        $favorite = Favorite::find($id);
        if ($favorite) {
            return response()->json($favorite); // Return the favorite if found
        } else {
            return response()->json(['message' => 'Favorite not found'], 404); // Return a 404 response if favorite not found
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $favorite = Favorite::find($id); // Find the favorite by ID
        if (!$favorite) {
            return response()->json(['message' => 'Favorite not found'], 404); // Return a 404 response if favorite not found
        }
        $favorite->delete(); // Delete the favorite
        return response()->json(['message' => 'Favorite deleted successfully']);
    }
}
