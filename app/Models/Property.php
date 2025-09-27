<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
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
    public function host()
    {
        return $this->belongsTo(Host::class);
    }
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }


}
