<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentInfo extends Model
{
     protected $fillable = [
        'mother_name','father_name','contact_number','contact_address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
     public function childinfos()
    {
        return $this->hasMany('App\ChildInfo','parentid');
    }
}
