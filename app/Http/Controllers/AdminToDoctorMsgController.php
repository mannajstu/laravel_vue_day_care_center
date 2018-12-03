<?php

namespace App\Http\Controllers;

use App\AdminToDoctorMsg;
use Auth;
use Illuminate\Http\Request;

class AdminToDoctorMsgController extends Controller
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
        $id     = Auth::user()->doctor->id;
        return AdminToDoctorMsg::where('doctorid',$id)->get();
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

            'email'          => 'required',
            'contact_number' => 'required',

            'doctorid'        => 'required',
            'subject'        => 'required',
            'message'        => 'required',

        ]);
        $admintodoctormsg= new AdminToDoctorMsg;
        $admintodoctormsg->email=$request->email;
        $admintodoctormsg->contact_number=$request->contact_number;
        $admintodoctormsg->doctorid=$request->doctorid;
        $admintodoctormsg->subject=$request->subject;
        $admintodoctormsg->message=$request->message;
        $admintodoctormsg->save();
        return $admintodoctormsg;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdminToDoctorMsg  $adminToDoctorMsg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return AdminToDoctorMsg::where('doctorid',$id)->get();
    }
     public function singleadmintodoctormsg($id)
    {
        return AdminToParentMsg::where('id',$id)->firstOrfail();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdminToDoctorMsg  $adminToDoctorMsg
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminToDoctorMsg $adminToDoctorMsg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdminToDoctorMsg  $adminToDoctorMsg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminToDoctorMsg $adminToDoctorMsg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdminToDoctorMsg  $adminToDoctorMsg
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminToDoctorMsg $adminToDoctorMsg)
    {
        //
    }
}
