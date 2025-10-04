<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'room_id',
        'available_date',
        'is_available',
    ]; 
    // Relationships
    // An availability belongs to a room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

}
