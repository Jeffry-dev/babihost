<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // Mass assignable attributes
    protected $fillable=[
        'user_id',
        'property_id',
        'rating',
        'comment',
    ];
    // Relationships
    // A review belongs to a property
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // A review belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
