<?php

namespace App\Http\Controllers;

use App\DoctorToParentMsg;
use Illuminate\Http\Request;

class DoctorToParentMsgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $doctortoparentmsg                 = new DoctorToParentMsg;
        $doctortoparentmsg->email          = $request->email;
        $doctortoparentmsg->contact_number = $request->contact_number;
        $doctortoparentmsg->childid        = $request->childid;
        $doctortoparentmsg->subject        = $request->subject;
        $doctortoparentmsg->message        = $request->message;
        $doctortoparentmsg->save();
        return $doctortoparentmsg;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DoctorToParentMsg  $doctorToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DoctorToParentMsg::where('childid', $id)->get();
    }
    public function singledoctortoparentmsg($id)
    {
        return DoctorToParentMsg::where('id', $id)->firstOrfail();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DoctorToParentMsg  $doctorToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function edit(DoctorToParentMsg $doctorToParentMsg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DoctorToParentMsg  $doctorToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoctorToParentMsg $doctorToParentMsg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DoctorToParentMsg  $doctorToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorToParentMsg $doctorToParentMsg)
    {
        //
    }
}
