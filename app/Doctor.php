<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'contact_address'
    ];

    public function childinfos()
    {
        return $this->hasMany('App\ChildInfo','doctorid');
    }
    public function user()
    {
        return $this->belongsTo('App\User','userid','id');
    }

}
