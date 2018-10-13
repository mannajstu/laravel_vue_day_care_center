<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildInfo extends Model
{
     protected $fillable = [
        'parentid','child_name','birth_date','birth_reg_no','gender','doctor_name','teacher_name','room_no',
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
}
