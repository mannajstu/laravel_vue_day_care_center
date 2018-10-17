<?php

namespace App\Http\Controllers;

use App\ParentInfo;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ParentInfoController extends Controller
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
        return ParentInfo::with('user')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            
            'mother_name'     => 'required',
            'father_name'     => 'required',
            'contact_number'  => 'required',
            'email'  => 'required',
            'contact_address' => 'required',
            
        ]);

         $user = new User;

        $user->name           = $request->father_name;
        $user->email          = $request->email;
        $user->password       = Hash::make('password');
        $user->contact_number = $request->contact_number;
        $user->save();

        $role = Role::where('name', 'parent')->first();
        // return $role;
        if (empty($role)) {
            $role       = new Role;
            $role->name = "parent";
            $role->save();
        }
        $user->roles()->attach( $role->id);

        $parent = new ParentInfo;

        $parent->mother_name     = $request->mother_name;
        $parent->contact_address = $request->contact_address;
        $parent->userid          = $user->id;
        $parent->save();
        return $parent;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ParentInfo  $parentInfo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parent = ParentInfo::where('id', $id)
        ->with('childinfos')
        ->with('user')
        ->first();

        return $parent;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ParentInfo  $parentInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(ParentInfo $parentInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ParentInfo  $parentInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request, [
            
            'mother_name'     => 'required',
            'father_name'     => 'required',
            'contact_number'  => 'required',
            'contact_address' => 'required',
            'email' => 'required',
            
        ]);

            $parent                =ParentInfo::findOrfail($id);
            $parent->mother_name     = $request->mother_name;
            $parent->user->email     = $request->email;
            $parent->user->name     = $request->father_name;
            $parent->user->contact_number  = $request->contact_number;
            $parent->contact_address = $request->contact_address;
            $parent->save();
            $parent->user->save();
            return $parent;
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ParentInfo  $parentInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParentInfo $parentInfo)
    {
        //
    }
}
