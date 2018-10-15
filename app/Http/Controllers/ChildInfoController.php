<?php

namespace App\Http\Controllers;

use App\ChildInfo;
use App\ParentInfo;
use Illuminate\Http\Request;

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
        return ChildInfo::with('parentinfo')->get();

        
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

        $oldparent = ParentInfo::where('contact_number', $request->contact_number)->first();

        if (!empty($oldparent)) {
            $parentid = $oldparent->id;
            $this->validate($request, [
                'child_name'     => 'required',
                'contact_number' => 'required',

                'birth_date'     => 'required',
                'birth_reg_no'   => 'required',
                'gender'         => 'required',
                'doctorid'    => 'required',
                'teacherid'   => 'required',
                'room_number'    => 'required',

            ]);

        } else {
            $this->validate($request, [

                'mother_name'     => 'required',
                'father_name'     => 'required',

                'contact_address' => 'required',
                'child_name'     => 'required',
                'contact_number' => 'required',

                'birth_date'     => 'required',
                'birth_reg_no'   => 'required',
                'gender'         => 'required',
                'doctorid'    => 'required',
                'teacherid'   => 'required',
                'room_number'    => 'required',

            ]);
            $parent                  = new ParentInfo;
            $parent->mother_name     = $request->mother_name;
            $parent->father_name     = $request->father_name;
            $parent->contact_number  = $request->contact_number;
            $parent->contact_address = $request->contact_address;
            $parent->save();
            $parentid = $parent->id;
        }

        $child = new ChildInfo;

        $child->child_name = $request->child_name;
        $child->parentid   = $parentid;

        $child->birth_date   = $request->birth_date;
        $child->birth_reg_no = $request->birth_reg_no;
        $child->gender       = $request->gender;
        $child->doctorid = $request->doctorid;
        $child->teacherid = $request->teacherid;
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
        ->with('parentinfo')
        ->with('doctor')
        ->with('teacher')
        ->first();

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
            'contact_number'  => 'required',
            'contact_address' => 'required',
            'birth_date'      => 'required',
            'birth_reg_no'    => 'required',
            'gender'          => 'required',
            'doctorid'     => 'required',
            'teacherid'    => 'required',
            'room_number'     => 'required',
        ]);

        $child             = ChildInfo::where('id', $id)->with('parentinfo')->first();
        $child->child_name = $request->child_name;

        $child->birth_date   = $request->birth_date;
        $child->birth_reg_no = $request->birth_reg_no;
        $child->gender       = $request->gender;
        $child->doctorid  = $request->doctorid;
        $child->teacherid = $request->teacherid;
        $child->room_number  = $request->room_number;

        $child->parentinfo->mother_name     = $request->mother_name;
        $child->parentinfo->father_name     = $request->father_name;
        $child->parentinfo->contact_number  = $request->contact_number;
        $child->parentinfo->contact_address = $request->contact_address;
        $child->save();
        $child->parentinfo->save();
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
