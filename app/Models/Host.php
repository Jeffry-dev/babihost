<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'user_id',
        'is_verified',
        'phone_number',
        'national_id',
        'bio',
        'profile_photo',
    ];
    // Relationships
    // A host belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A host has many properties
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

}
