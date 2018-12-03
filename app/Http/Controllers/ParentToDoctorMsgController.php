<?php

namespace App\Http\Controllers;

use App\ParentToDoctorMsg;
use Illuminate\Http\Request;

class ParentToDoctorMsgController extends Controller
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
        $parenttodoctormsg                 = new ParentToDoctorMsg;
        $parenttodoctormsg->email          = $request->email;
        $parenttodoctormsg->contact_number = $request->contact_number;
        $parenttodoctormsg->childid        = $request->childid;
        $parenttodoctormsg->subject        = $request->subject;
        $parenttodoctormsg->message        = $request->message;
        $parenttodoctormsg->save();
        return $parenttodoctormsg;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ParentTodoctormsg  $parentTodoctormsg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ParentToDoctorMsg::where('childid', $id)->get();
    }
    public function singleparentTodoctormsg($id)
    {
        return ParentToDoctorMsg::where('id', $id)->firstOrfail();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ParentToDoctorMsg  $parentToDoctorMsg
     * @return \Illuminate\Http\Response
     */
    public function edit(ParentToDoctorMsg $parentToDoctorMsg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ParentToDoctorMsg  $parentToDoctorMsg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParentToDoctorMsg $parentToDoctorMsg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ParentToDoctorMsg  $parentToDoctorMsg
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParentToDoctorMsg $parentToDoctorMsg)
    {
        //
    }
}
