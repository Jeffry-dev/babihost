<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // Mass assignable attributes
    protected $fillable = [
    'user_id',
    'room_id',
    'check_in_date',
    'check_out_date',
    'number_of_guests',
    'total_price',
    'status',
    ];
    // Relationships
    // A booking belongs to a room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // A booking has one payment 
    public function payment()
    {
        return $this->hasOne(Payment::class);
    } 

    // A booking belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

}
