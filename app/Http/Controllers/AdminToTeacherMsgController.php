<?php

namespace App\Http\Controllers;

use App\AdminToTeacherMsg;
use Auth;
use Gate;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

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
        if (Gate::allows('isTeacher')) {
            $id     = Auth::user()->teacher->id;
        return AdminToTeacherMsg::where('teacherid',$id)->orderBy('created_at', 'desc')

                ->paginate(4);
    }
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
       if (Gate::allows('isAdmin')) {
         $this->validate($request, [

                'email'          => 'required|email',
                'contact_number' => 'required|numeric',

                'teacherid'       => 'required|numeric',
                'subject'        => 'required|min:3',
                'message'        => 'required|min:3|max:100000',

            ]);
        $admintoteachermsg= new AdminToTeacherMsg;
        $admintoteachermsg->email=$request->email;
        $admintoteachermsg->contact_number=$request->contact_number;
        $admintoteachermsg->teacherid=$request->teacherid;
        $admintoteachermsg->subject=$request->subject;
        $admintoteachermsg->message=$request->message;
        $admintoteachermsg->save();

        $messageinfo = 'Sub: ' . $admintoteachermsg->subject . ' Details: ' . $admintoteachermsg->message;

            $usernumber = '88' . $admintoteachermsg->contact_number;

            Nexmo::message()->send([
                'to'   => $usernumber,
                'from' => '16105552344',
                'text' => $messageinfo,
            ]);

        return $admintoteachermsg;
    }
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
            return AdminToTeacherMsg::where('teacherid',$id)->orderBy('created_at', 'desc')

                ->paginate(4);
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
