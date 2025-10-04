<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade'); // link to bookings table
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // link to users table
            $table->foreignId('property_id')->constrained()->onDelete('cascade'); // link to properties table
            $table->decimal('amount', 10, 2); // e.g., 99999999.99
            $table->string('payment_method'); // e.g., credit card, PayPal
            $table->string('transaction_id')->unique(); // unique transaction identifier
            $table->string('status')->default('pending'); // e.g., pending, completed, failed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
