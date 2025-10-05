<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Availability;

class AvailabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all availabilities
        $availabilities = Availability::all();
        return response()->json($availabilities);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'available_date'=>'required|date',
            'is_available' => 'required|boolean',
        ]);

        // Create the availability
        $availability = Availability::create($validatedData);
        return response()->json(['message' => 'Availability created successfully', 
        'availability' => $availability
    ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the availability by ID
        $availability = Availability::find($id);
        if ($availability) {
            return response()->json($availability); // Return the availability if found
        } else {
            return response()->json(['message' => 'Availability not found'], 404); // Return a 404 response if availability not found
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the availability by ID
        $availability = Availability::find($id);
        if (!$availability) {
            return response()->json(['message' => 'Availability not found'], 404); // Return a 404 response if availability not found
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'room_id' => 'exists:rooms,id',
            'available_date'=>'date',
            'is_available' => 'boolean',
        ]);

        // Update the availability
        $availability->update($validatedData);
        return response()->json(['message' => 'Availability updated successfully', 
        'availability' => $availability
    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the availability by ID
        $availability = Availability::find($id);
        if (!$availability) {
            return response()->json(['message' => 'Availability not found'], 404); // Return a 404 response if availability not found
        }
        $availability->delete(); // Delete the availability
        return response()->json(['message' => 'Availability deleted successfully']);
    }
}
