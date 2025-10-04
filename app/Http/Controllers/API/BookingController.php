<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all bookings
        $bookings = Booking::all();
        return response()->json($bookings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'number_of_guests' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending,confirmed,cancelled,completed',
        ]);

        // Create the booking
        $booking = Booking::create($validatedData);
        return response()->json(['message' => 'Booking created successfully', 
        'booking' => $booking
    ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the booking by ID
        $booking = Booking::find($id);
        if ($booking) {
            return response()->json($booking); // Return the booking if found
        } else {
            return response()->json(['message' => 'Booking not found'], 404); // Return a 404 response if booking not found
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the booking by ID
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'exists:users,id',
            'room_id' => 'exists:rooms,id',
            'check_in_date' => 'date|after_or_equal:today',
            'check_out_date' => 'date|after:check_in_date',
            'number_of_guests' => 'integer|min:1',
            'total_price' => 'numeric|min:0',
            'status' => 'string|in:pending,confirmed,cancelled,completed',
        ]);

        // Update the booking with validated data
        $booking->update($validatedData);
        return response()->json(['message' => 'Booking updated successfully', 
        'booking' => $booking
    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the booking by ID
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        // Delete the booking
        $booking->delete();
        return response()->json(['message' => 'Booking deleted successfully']);
    }
}
