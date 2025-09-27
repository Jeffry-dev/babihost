<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    protected $fillable = [
        'user_id',
        'is_verified',
        'phone_number',
        'national_id',
        'bio',
        'profile_photo',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

}
