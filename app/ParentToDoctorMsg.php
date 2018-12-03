<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentToDoctorMsg extends Model
{
    protected $fillable = [
        'subject','message','childid','email','contact_number',
    ];
}
