<?php

namespace App\Http\Controllers;

use App\TeacherToParentMsg;
use Illuminate\Http\Request;

class TeacherToParentMsgController extends Controller
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
        $teachertoparentmsg                 = new TeacherToParentMsg;
        $teachertoparentmsg->email          = $request->email;
        $teachertoparentmsg->contact_number = $request->contact_number;
        $teachertoparentmsg->childid        = $request->childid;
        $teachertoparentmsg->subject        = $request->subject;
        $teachertoparentmsg->message        = $request->message;
        $teachertoparentmsg->save();
        return $teachertoparentmsg;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TeacherToParentMsg  $teacherToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return TeacherToParentMsg::where('childid', $id)->get();
    }
    public function singleteachertoparentmsg($id)
    {
        return TeacherToParentMsg::where('id', $id)->firstOrfail();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeacherToParentMsg  $teacherToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherToParentMsg $teacherToParentMsg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TeacherToParentMsg  $teacherToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeacherToParentMsg $teacherToParentMsg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeacherToParentMsg  $teacherToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherToParentMsg $teacherToParentMsg)
    {
        //
    }
}
