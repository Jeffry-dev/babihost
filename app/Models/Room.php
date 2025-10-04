<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'property_id',
        'room_type',
        'capacity',
        'price_per_night',
        
    ];
    //Relationships
    // A room belongs to a property
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    // A room has many bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // A room has many availabilities
    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }


}
