<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // Retrieve all properties
        $properties = Property::all();
        return response()->json($properties); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
        'host_id' => 'required|exists:hosts,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'address' => 'required|string|max:255',
        'country' => 'required|string|max:100',
        'city' => 'required|string|max:100',
        'postal_code' => 'required|string|max:20',
        'property_type' => 'required|string|in:apartment,house,villa,studio',
        ]);

        // Create the property
        $property = Property::create($validatedData);
        return response()->json(['message' => 'Property created successfully', 
        'property' => $property
    ], 201);    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the property by ID
        $property = Property::find($id);
        if ($property) {
            return response()->json($property); // Return the property if found
        } else {
            return response()->json(['message' => 'Property not found'], 404); // Return a 404 response if property not found
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the property by ID
        $property = Property::find($id);
        if (!$property) {
            return response()->json(['message' => 'Property not found'], 404);
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'host_id' => 'exists:hosts,id',
            'title' => 'string|max:255',
            'description' => 'string',
            'address' => 'string|max:255',
            'country' => 'string|max:100',
            'city' => 'string|max:100',
            'postal_code' => 'string|max:20',
            'property_type' => 'string|in:apartment,house,villa,studio',
        ]);

        // Update the property with validated data
        $property->update($validatedData);
        return response()->json(['message' => 'Property updated successfully', 
        'property' => $property
    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the property by ID
        $property = Property::find($id);
        if (!$property) {
            return response()->json(['message' => 'Property not found'], 404);
        }

        // Delete the property
        $property->delete();
        return response()->json(['message' => 'Property deleted successfully']);
    }
}
