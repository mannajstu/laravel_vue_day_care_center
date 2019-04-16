<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemChild extends Model
{
     protected $fillable = [
        'child_name','birth_date','birth_reg_no','gender', 'mother_name','father_name','email',
        'contact_address','contact_number'
    ];
}
