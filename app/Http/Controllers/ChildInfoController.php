<?php

namespace App\Http\Controllers;

use App\ChildInfo;
use App\ParentInfo;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChildInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $child= ChildInfo::with('parentinfo.user')->get();
        return $child;

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
            'email'           => 'required',

            'contact_address' => 'required',
            'child_name'      => 'required',
            'contact_number'  => 'required',

            'birth_date'      => 'required',
            'birth_reg_no'    => 'required',
            'gender'          => 'required',
            'doctorid'        => 'required',
            'teacherid'       => 'required',
            'room_number'     => 'required',

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

        // }

        $child = new ChildInfo;

        $child->child_name = $request->child_name;
        $child->parentid   = $parent->id;

        $child->birth_date   = $request->birth_date;
        $child->birth_reg_no = $request->birth_reg_no;
        $child->gender       = $request->gender;
        $child->doctorid     = $request->doctorid;
        $child->teacherid    = $request->teacherid;
        $child->room_number  = $request->room_number;
        $child->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChildInfo  $childInfo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $child = ChildInfo::where('id', $id)
            ->with('parentinfo.user')
            ->with('doctor.user')
            ->with('teacher.user')
            ->firstOrFail();

        return $child;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChildInfo  $childInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(ChildInfo $childInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChildInfo  $childInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'child_name'      => 'required',
            'mother_name'     => 'required',
            'father_name'     => 'required',
            'email'     => 'required',
            'contact_number'  => 'required',
            'contact_address' => 'required',
            'birth_date'      => 'required',
            'birth_reg_no'    => 'required',
            'gender'          => 'required',
            'doctorid'        => 'required',
            'teacherid'       => 'required',
            'room_number'     => 'required',
        ]);

        $child             = ChildInfo::where('id', $id)
                            ->with('parentinfo.user')
                            ->first();


        $child->child_name = $request->child_name;

        $child->birth_date   = $request->birth_date;
        $child->birth_reg_no = $request->birth_reg_no;
        $child->gender       = $request->gender;
        $child->doctorid     = $request->doctorid;
        $child->teacherid    = $request->teacherid;
        $child->room_number  = $request->room_number;

        $child->parentinfo->mother_name     = $request->mother_name;
        $child->parentinfo->contact_address = $request->contact_address;
        
        $child->parentinfo->user->name     = $request->father_name;
        $child->parentinfo->user->email     = $request->email;
        $child->parentinfo->user->contact_number  = $request->contact_number;
        
        $child->save();
        $child->parentinfo->save();
        $child->parentinfo->user->save();
//         $child->parentinfo()->update(['mother_name' =>$request->mother_name,

// 'father_name' => $request->father_name,
        // 'contact_number' => $request->contact_number,
        // 'contact_address' => $request->contact_address,
        //     ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChildInfo  $childInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChildInfo $childInfo)
    {
        //
    }
}
