<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
     protected $fillable = [
        'teacher_name','teacher_email','contact_number','contact_address'
    ];

    public function childinfos()
    {
        return $this->hasMany('App\ChildInfo','teacherid');
    }
}