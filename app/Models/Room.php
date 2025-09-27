<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'property_id',
        'room_type',
        'bed_count',
        'amenities',
        'price_per_night',
        'availability_status',
    ];
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }


}
