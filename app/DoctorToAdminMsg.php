<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorToAdminMsg extends Model
{
   protected $fillable = [
        'subject','message','doctorid','email','contact_number',
    ];
}
