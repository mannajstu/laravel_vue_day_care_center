<?php

namespace App\Http\Controllers;

use App\AdminToParentMsg;
use Illuminate\Http\Request;

class AdminToParentMsgController extends Controller
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
        // return AdminToParentMsg::all();
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

            'childid'        => 'required',
            'subject'        => 'required',
            'message'        => 'required',

        ]);
        $admintoparentmsg= new AdminToParentMsg;
        $admintoparentmsg->email=$request->email;
        $admintoparentmsg->contact_number=$request->contact_number;
        $admintoparentmsg->childid=$request->childid;
        $admintoparentmsg->subject=$request->subject;
        $admintoparentmsg->message=$request->message;
        $admintoparentmsg->save();
        return $admintoparentmsg;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdminToParentMsg  $adminToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return AdminToParentMsg::where('childid',$id)->get();
    }
     public function singleadmintoparentmsg($id)
    {
        return AdminToParentMsg::where('id',$id)->firstOrfail();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdminToParentMsg  $adminToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminToParentMsg $adminToParentMsg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdminToParentMsg  $adminToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminToParentMsg $adminToParentMsg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdminToParentMsg  $adminToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminToParentMsg $adminToParentMsg)
    {
        //
    }
}
