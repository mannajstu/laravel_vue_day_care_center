<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'doctor_name','doctor_email','contact_number','contact_address'
    ];

    public function childinfos()
    {
        return $this->hasMany('App\ChildInfo','doctorid');
    }

}
