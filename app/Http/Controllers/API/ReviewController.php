<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all reviews
        $reviews = Review::all();
        return response()->json($reviews);
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
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        // Create the review
        $review = Review::create([
            'user_id' => $validatedData['user_id'],
            'property_id' => $validatedData['property_id'],
            'rating' => $validatedData['rating'],
            'comment' => $validatedData['comment'] ?? null,// Optional field
        ]);

        return response()->json(['message' => 'Review created successfully', 'review' => $review], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the review by ID
        $review = Review::find($id);
        if ($review) {
            return response()->json($review); // Return the review if found
        } else {
            return response()->json(['message' => 'Review not found'], 404); // Return a 404 response if review not found
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $review = Review::find($id); // Find the review by ID
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404); // Return a 404 response if review not found
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'property_id' => 'sometimes|required|exists:properties,id',
            'rating' => 'sometimes|required|integer|min:1|max:5',
            'comment' => 'sometimes|nullable|string',
        ]);

        // Update the review with validated data
        $review->update($validatedData);

        return response()->json(['message' => 'Review updated successfully', 'review' => $review]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::find($id); // Find the review by ID
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404); // Return a 404 response if review not found
        }
        $review->delete(); // Delete the review
        return response()->json(['message' => 'Review deleted successfully']);
    }
}
