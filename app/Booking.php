<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $fillable = [
        'user_id',
        'name', 'adress', 'city', 'phone',
        'place_id', 'plus_code',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function guest(){
        return $this->hasMany(Guest::class);
    }

}
