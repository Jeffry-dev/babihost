<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all rooms
        $rooms = Room::all();
        return response()->json($rooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'room_type' => 'required|string|in:single,double,suite,studio',
            'capacity' => 'required|integer|min:1',
            'price_per_night' => 'required|numeric|min:0',
        ]);

        // Create the room
        $room = Room::create($validatedData);
        return response()->json(['message' => 'Room created successfully', 
        'room' => $room
    ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the room by ID
        $room = Room::find($id);
        if ($room) {
            return response()->json($room); // Return the room if found
        } else {
            return response()->json(['message' => 'Room not found'], 404); // Return a 404 response if room not found
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the room by ID
        $room = Room::find($id);
        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'property_id' => 'exists:properties,id',
            'room_type' => 'string|in:single,double,suite,studio',
            'capacity' => 'integer|min:1',
            'price_per_night' => 'numeric|min:0',
        ]);

        // Update the room with validated data
        $room->update($validatedData);
        return response()->json(['message' => 'Room updated successfully', 'room' => $room]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the room by ID
        $room = Room::find($id);
        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);
        }

        // Delete the room
        $room->delete();
        return response()->json(['message' => 'Room deleted successfully']);
    }
}
