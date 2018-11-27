<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralNotice extends Model
{
    protected $fillable = [
        'title','description'
    ];
}
