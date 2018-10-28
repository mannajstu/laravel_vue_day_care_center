<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\ParentInfo;
use App\Role;
use App\Teacher;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::with('roles')->get();
    }
    public function adminActivation(Request $request)
    {
        $activationCode = 'activationCode';
        if ($activationCode==$request->admin_activation) {
            $id = Auth::id();

            $user = User::findOrfail($id);
            $role = Role::where('name', 'admin')->first();
            $user->roles()->attach($role->id);
            return $user;

        }
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;

        $user->name           = $request->name;
        $user->email          = $request->email;
        $user->password       = Hash::make('password');
        $user->contact_number = $request->contact_number;
        $user->save();

        $role = Role::where('name', 'admin')->first();
        // return $role;
        if (empty($role)) {
            $role       = new Role;
            $role->name = "admin";
            $role->save();
        }
        $user->roles()->attach($role->id);
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)
            ->with('roles')
            ->with('parent.childinfos')
            ->first();

        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'name'           => 'required',
            'email'          => 'required',
            'contact_number' => 'required',

        ]);
        $user = User::findOrfail($id);

        $user->email          = $request->email;
        $user->name           = $request->name;
        $user->contact_number = $request->contact_number;

        $user->save();
        $user->roles()->detach();

        $roles = Role::whereIn('name', $request->role)->get();
        $user->roles()->attach($roles);
        $address = "Please Insert Your Contact Address";

        foreach ($user->roles()->get() as $role) {
            if ($role->name === 'teacher') {
                if (Teacher::where('userid', $user->id)->first() === null) {
                    $user->addTeacher($user->id, $address);

                }

            }

            if ($role->name === 'doctor') {
                if (Doctor::where('userid', $user->id)->first() === null) {
                    $user->addDoctor($user->id, $address);

                }
            }

            if ($role->name === 'parent') {
                if (ParentInfo::where('userid', $user->id)->first() === null) {
                    $mothername = "Insert Mother Name";

                    $user->addParent($user->id, $address, $mothername);
                }
            }

        }

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
