<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestToAdminMsg extends Model
{
    protected $fillable = [
        'subject','message','email','contact_number',
    ];
}
