<?php

namespace App\Http\Controllers;

use App\ParentToAdminMsg;
use Illuminate\Http\Request;

class ParentToAdminMsgController extends Controller
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
        $parenttoadminmsg                 = new ParentToAdminMsg;
        $parenttoadminmsg->email          = $request->email;
        $parenttoadminmsg->contact_number = $request->contact_number;
        $parenttoadminmsg->childid        = $request->childid;
        $parenttoadminmsg->subject        = $request->subject;
        $parenttoadminmsg->message        = $request->message;
        $parenttoadminmsg->save();
        return $parenttoadminmsg;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ParentToAdminMsg  $parentToAdminMsg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ParentToAdminMsg::where('childid', $id)->get();
    }
    public function singleparentToadminmsg($id)
    {
        return ParentToAdminMsg::where('id', $id)->firstOrfail();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ParentToAdminMsg  $parentToAdminMsg
     * @return \Illuminate\Http\Response
     */
    public function edit(ParentToAdminMsg $parentToAdminMsg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ParentToAdminMsg  $parentToAdminMsg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParentToAdminMsg $parentToAdminMsg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ParentToAdminMsg  $parentToAdminMsg
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParentToAdminMsg $parentToAdminMsg)
    {
        //
    }
}
