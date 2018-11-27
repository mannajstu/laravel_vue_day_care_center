<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table    = 'exams';
    protected $fillable = [
      ' exam_title','exam_description','exam_date','exam_time','exam_mark','class_number'
    ];

    public function classinfo()
    {
        return $this->belongsTo('App\ClassInfo', 'class_number','class_number');
    }
}
