<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminToDoctorMsg extends Model
{
    protected $fillable = [
        'subject','message','doctorid','email','contact_number',
    ];
}
