<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildInfo extends Model
{
     protected $fillable = [
        'parentid','child_name','birth_date','birth_reg_no','gender','doctorid','teacherid','room_no',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    public function parentinfo()
    {
        return $this->belongsTo('App\ParentInfo','parentid','id');
    }
    public function room()
    {
        return $this->belongsTo('App\Room','room_number','room_number');
    }
    public function doctor()
    {
        return $this->belongsTo('App\Doctor','doctorid','id');
    }
    public function teacher()
    {
        return $this->belongsTo('App\Teacher','teacherid','id');
    }

    public function exams()
    {
        return $this->belongsToMany('App\Exam', 'childexam', 'childid', 'examid')->withTimestamps();
    }
}
