<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminToParentMsg extends Model
{
    protected $fillable = [
        'subject','message','childid','email','contact_number',
    ];
}
