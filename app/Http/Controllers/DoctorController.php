<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Doctor::with('user')->get();
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

        $this->validate($request, [

            'doctor_name'     => 'required',
            'doctor_email'    => 'required',
            'contact_number'  => 'required',
            'contact_address' => 'required',

        ]);

        $user = new User;

        $user->name           = $request->doctor_name;
        $user->email          = $request->doctor_email;
        $user->password       = Hash::make('password');
        $user->contact_number = $request->contact_number;
        $user->save();

        $role = Role::where('name', 'doctor')->first();
        // return $role;
        if (empty($role)) {
            $role       = new Role;
            $role->name = "doctor";
            $role->save();
        }
        $user->roles()->attach($role->id);
        $doctor = new Doctor;

        $doctor->contact_address = $request->contact_address;
        $doctor->userid          = $user->id;
        $doctor->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::where('id', $id)
        ->with('childinfos')
        ->with('user')
        ->first();

        return $doctor;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)

    {
        $this->validate($request, [

            'doctor_name'     => 'required',
            'doctor_email'    => 'required',
            'contact_number'  => 'required',
            'contact_address' => 'required',

        ]);
        $doctor                =Doctor::findOrfail($id);
            
            $doctor->user->email     = $request->doctor_email;
            $doctor->user->name     = $request->doctor_name;
            $doctor->user->contact_number  = $request->contact_number;
            $doctor->contact_address = $request->contact_address;
            $doctor->save();
            $doctor->user->save();
            return $doctor;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
