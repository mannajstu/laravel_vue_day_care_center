<?php

namespace App\Providers;

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
           if($role->name==='admin'){
            return true;
           }
        }
    });
        //parent

          Gate::define('isAdminParent', function ($user) {
        $roles= $user->roles()->get();
        foreach ($roles as $role) {
           if($role->name==='parent'||$role->name==='admin'){
            return true;
           }
        }
    });

            Gate::define('isAdminDoctor', function ($user) {
        $roles= $user->roles()->get();
        foreach ($roles as $role) {
           if($role->name==='doctor'||$role->name==='admin'){
            return true;
           }
        }
    });

              Gate::define('isAdminTeacher', function ($user) {
        $roles= $user->roles()->get();
        foreach ($roles as $role) {
           if($role->name==='teacher'||$role->name==='admin'){
            return true;
           }
        }
    });



    }
}
