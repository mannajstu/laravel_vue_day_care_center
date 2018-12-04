<?php

namespace App\Http\Controllers;

use App\AdminToTeacherMsg;
use Auth;
use Gate;
use Illuminate\Http\Request;

class AdminToTeacherMsgController extends Controller
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
        $id     = Auth::user()->teacher->id;
        return AdminToTeacherMsg::where('teacherid',$id)->get();
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

            'teacherid'        => 'required',
            'subject'        => 'required',
            'message'        => 'required',

        ]);
        $AdminToTeacherMsg= new AdminToTeacherMsg;
        $AdminToTeacherMsg->email=$request->email;
        $AdminToTeacherMsg->contact_number=$request->contact_number;
        $AdminToTeacherMsg->teacherid=$request->teacherid;
        $AdminToTeacherMsg->subject=$request->subject;
        $AdminToTeacherMsg->message=$request->message;
        $AdminToTeacherMsg->save();
        return $AdminToTeacherMsg;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdminToTeacherMsg  $AdminToTeacherMsg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         if (Gate::allows('isAdmin')) {
            return AdminToTeacherMsg::where('teacherid',$id)->get();
    }
    }
     public function singleAdminToTeacherMsg($id)
    {
       if (Gate::allows('isAdmin')) {
           return  AdminToTeacherMsg::where('id',$id)->firstOrfail();
        } elseif(Gate::allows('isTeacher')) {
             $teacherid =Auth::user()->teacher->id;
            return  AdminToTeacherMsg::where([
                'id' => $id,
                'teacherid' => $teacherid,
                
            ])->firstOrfail();
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdminToTeacherMsg  $adminToTeacherMsg
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminToTeacherMsg $adminToTeacherMsg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdminToTeacherMsg  $adminToTeacherMsg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminToTeacherMsg $adminToTeacherMsg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdminToTeacherMsg  $adminToTeacherMsg
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminToTeacherMsg $adminToTeacherMsg)
    {
        //
    }
}
