<?php

namespace App\Http\Controllers;

use App\ParentToTeacherMsg;
use Illuminate\Http\Request;

class ParentToTeacherMsgController extends Controller
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
        $parenttoteachermsg                 = new ParenttoTeacherMsg;
        $parenttoteachermsg->email          = $request->email;
        $parenttoteachermsg->contact_number = $request->contact_number;
        $parenttoteachermsg->childid        = $request->childid;
        $parenttoteachermsg->subject        = $request->subject;
        $parenttoteachermsg->message        = $request->message;
        $parenttoteachermsg->save();
        return $parenttoteachermsg;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Parenttoteachermsg  $parenttoteachermsg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ParenttoTeacherMsg::where('childid', $id)->get();
    }
    public function singleparenttoteachermsg($id)
    {
        return ParenttoTeacherMsg::where('id', $id)->firstOrfail();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ParentToTeacherMsg  $parentToTeacherMsg
     * @return \Illuminate\Http\Response
     */
    public function edit(ParentToTeacherMsg $parentToTeacherMsg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ParentToTeacherMsg  $parentToTeacherMsg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParentToTeacherMsg $parentToTeacherMsg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ParentToTeacherMsg  $parentToTeacherMsg
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParentToTeacherMsg $parentToTeacherMsg)
    {
        //
    }
}
