<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminToTeacherMsg extends Model
{
    protected $fillable = [
        'subject','message','teacherid','email','contact_number',
    ];
}
