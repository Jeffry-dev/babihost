<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'host_id',
        'title',
        'description',
        'address',
        'country',
        'city',
        'postal_code',
        'property_type',
    ];
    // Relationships
    // A property belongs to a host
    public function host()
    {
        return $this->belongsTo(Host::class);
    }

    // A property has many rooms
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    // A property has many reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // A property has many favorites
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // A property has many payments
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }


}
