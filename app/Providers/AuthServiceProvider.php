<?php

namespace App\Providers;
use Session;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
//admin
        Gate::define('isAdmin', function ($user) {
        $roles= $user->roles()->get();
        foreach ($roles as $role) {
           if($role->name==='admin' && Session::get('role')=='admin'){
            return true;
           }
        }
    });
        //parent

          Gate::define('isParent', function ($user) {
        $roles= $user->roles()->get();
        foreach ($roles as $role) {
           if($role->name==='parent' && Session::get('role')=='parent'){
            return true;
           }
        }
    });

            Gate::define('isDoctor', function ($user) {
        $roles= $user->roles()->get();
        foreach ($roles as $role) {
           if($role->name==='doctor' && Session::get('role')=='doctor'){
            return true;
           }
        }
    });

              Gate::define('isTeacher', function ($user) {
        $roles= $user->roles()->get();
        foreach ($roles as $role) {
           if($role->name==='teacher' && Session::get('role')=='teacher'){
            return true;
           }
        }
    });



    }
}
