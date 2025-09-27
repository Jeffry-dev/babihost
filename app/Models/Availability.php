<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $fillable = [
        'room_id',
        'available_date',
        'is_available',
    ];
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    


}
