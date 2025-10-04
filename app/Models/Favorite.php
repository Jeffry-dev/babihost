<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'user_id',
        'property_id',
    ];
    // Relationships
    // A favorite belongs to a property
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // A favorite belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
