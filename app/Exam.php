<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table    = 'exams';
    protected $fillable = [
      ' exam_title','exam_description','exam_date','exam_time','exam_mark',
    ];

    public function children()
    {
        return $this->belongsToMany('App\ChildInfo', 'childexam','examid','childid')->withTimestamps();
    }
}
