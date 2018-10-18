<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','contact_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function roles()
    {
        return $this->belongsToMany('App\Role', 'userrole', 'userid', 'roleid')->withTimestamps();
    }

    public function parent()
    {
        return $this->hasOne('App\ParentInfo','userid');
    }
    public function doctor()
    {
        return $this->hasOne('App\Doctor','userid');
    }
     public function teacher()
    {
        return $this->hasOne('App\Teacher','userid');
    }
}
