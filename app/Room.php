<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number','room_capacity','room_description'
    ];

    public function childrooms()
    {
        return $this->hasMany('App\ChildInfo','room_number','room_number');
    }
}
