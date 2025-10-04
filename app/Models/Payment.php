<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // Mass assignable attributes
     protected $fillable = [
        'booking_id',
        'user_id',
        'property_id',
        'amount',
        'payment_method',
        'transaction_id',
        'status',
    ];
    // Relationships
    // A payment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A payment belongs to a booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    // A payment belongs to a property
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

 
}
