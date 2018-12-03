<?php

namespace App\Http\Controllers;

use App\DoctorToAdminMsg;
use Auth;
use Illuminate\Http\Request;

class DoctorToAdminMsgController extends Controller
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
    {$id     = Auth::user()->doctor->id;
        return DoctorToAdminMsg::where('doctorid',$id)->get();
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
        $doctortoadminmsg= new DoctorToAdminMsg;
        $doctortoadminmsg->email=$request->email;
        $doctortoadminmsg->contact_number=$request->contact_number;
        $doctortoadminmsg->doctorid=$request->doctorid;
        $doctortoadminmsg->subject=$request->subject;
        $doctortoadminmsg->message=$request->message;
        $doctortoadminmsg->save();
        return $doctortoadminmsg;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdminToDoctorMsg  $doctortoadminMsg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DoctorToAdminMsg::where('doctorid',$id)->get();
    }
     public function singledoctortoadminmsg($id)
    {
        return  DoctorToAdminMsg::where('id',$id)->firstOrfail();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DoctorToAdminMsg  $doctorToAdminMsg
     * @return \Illuminate\Http\Response
     */
    public function edit(DoctorToAdminMsg $doctorToAdminMsg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DoctorToAdminMsg  $doctorToAdminMsg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoctorToAdminMsg $doctorToAdminMsg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DoctorToAdminMsg  $doctorToAdminMsg
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorToAdminMsg $doctorToAdminMsg)
    {
        //
    }
}
