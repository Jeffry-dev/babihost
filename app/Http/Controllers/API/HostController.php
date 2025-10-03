<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Host;

class HostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all hosts
        $hosts = Host::all();
        return response()->json($hosts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'is_verified' => 'boolean',
            'bio' => 'nullable|string',
            'phone_number' => 'required|string|max:15',
            'national_id' => 'required|string|max:20|unique:hosts',
        ]);

        // Create the host
        $host = Host::create($validatedData);
        return response()->json(['message' => 'Host created successfully', 
        'host' => $host
    ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the host by ID
        $host = Host::find($id);
        if ($host) {
            return response()->json($host); // Return the host if found
        } else {
            return response()->json(['message' => 'Host not found'], 404); // Return a 404 response if host not found
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the host by ID
        $host = Host::find($id);
        if (!$host) {
            return response()->json(['message' => 'Host not found'], 404);
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'is_verified' => 'boolean',
            'bio' => 'nullable|string',
            'phone_number' => 'nullable|string|max:15',
            'national_id' => 'nullable|string|max:20|unique:hosts,national_id,' . $id,
        ]);

        // Update the host
        $host->update($validatedData);
        return response()->json(['message' => 'Host updated successfully', 'host' => $host]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the host by ID
        $host = Host::find($id);
        if (!$host) {
            return response()->json(['message' => 'Host not found'], 404);
        }

        // Delete the host
        $host->delete();
        return response()->json(['message' => 'Host deleted successfully']);
    }
}
