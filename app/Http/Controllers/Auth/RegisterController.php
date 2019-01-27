<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'           => 'required|string|max:255',
            'email'          => 'required|string|email|max:255|unique:users',
            'contact_number' => 'required|numeric|unique:users,contact_number',
            'password'       => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user                 = new User;
        $user->name           = $data['name'];
        $user->email          = $data['email'];
        $user->password       = Hash::make($data['password']);
        $user->contact_number = $data['contact_number'];

        $role      = Role::where('name', 'parent')->first();
        $adminrole = Role::where('name', 'admin')->first();
        // return $role;
        if (empty($adminrole)) {
            $role       = new Role;
            $role->name = "admin";
            $role->save();
            $parentrole       = new Role;
            $parentrole->name = "parent";
            $parentrole->save();
            $drole       = new Role;
            $drole->name = "doctor";
            $drole->save();
            $trole       = new Role;
            $trole->name = "teacher";
            $trole->save();
            $user->active = 1;
        } else {
            if (empty($role)) {
                $role       = new Role;
                $role->name = "parent";
                $role->save();
            }
            $user->active = 0;
        }
        $user->save();
        $user->addParent($user->id, 'Update Your Address', 'Update Info');
        $user->roles()->attach($role->id);

       if(!empty($user)){
        Mail::send('useremail', ["data" => $data], function ($message) use ($user) {
            $message->to($user->email)->subject('Login Info');
            $message->from('admin@gmail.com', 'Day Care Center');
        });
       } 

        return $user;
    }
}
