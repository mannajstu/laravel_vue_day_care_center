<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassInfo extends Model
{
    protected $fillable = [
        'class_number','class_description'
    ];

    public function childinfos()
    {
        return $this->hasMany('App\ChildInfo','class_number','class_number');
    }
    public function exams()
    {
        return $this->hasMany('App\Exam','class_number','class_number');
    }
}
