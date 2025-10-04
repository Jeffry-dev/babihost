<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all payments
        $payments = Payment::all();
        return response()->json($payments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|in:credit_card,paypal,bank_transfer',
            'transaction_id' => 'required|string|unique:payments',
            'status' => 'required|string|in:pending,completed,failed',
        ]);

        // Create the payment
        $payment = Payment::create($validatedData);
        return response()->json(['message' => 'Payment created successfully', 
        'payment' => $payment
    ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the payment by ID
        $payment = Payment::find($id);
        if ($payment) {
            return response()->json($payment); // Return the payment if found
        } else {
            return response()->json(['message' => 'Payment not found'], 404); // Return a 404 response if payment not found
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the payment by ID
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404); // Return a 404 response if payment not found
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'booking_id' => 'exists:bookings,id',
            'user_id' => 'exists:users,id',
            'amount' => 'numeric|min:0',
            'payment_method' => 'string|in:credit_card,paypal,bank_transfer',
            'status' => 'string|in:pending,completed,failed',
        ]);

        // Update the payment
        $payment->update($validatedData);
        return response()->json(['message' => 'Payment updated successfully', 
        'payment' => $payment
    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the payment by ID
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404); // Return a 404 response if payment not found
        }

        // Delete the payment
        $payment->delete();
        return response()->json(['message' => 'Payment deleted successfully']);
    }
}
