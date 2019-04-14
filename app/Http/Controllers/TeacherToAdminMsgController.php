<?php

namespace App\Http\Controllers;

use App\TeacherToAdminMsg;
use Auth;
use Gate;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class TeacherToAdminMsgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        if (Gate::allows('isTeacher')) {
            $id     = Auth::user()->teacher->id;
        return TeacherToAdminMsg::where('teacherid',$id)->orderBy('created_at', 'desc')

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
       if (Gate::allows('isTeacher')) {
         $this->validate($request, [

                'email'          => 'required|email',
                'contact_number' => 'required|numeric',

                'teacherid'       => 'required|numeric',
                'subject'        => 'required|min:3',
                'message'        => 'required|min:3|max:100000',

            ]);
        $teachertoadminmsg= new TeacherToAdminMsg;
        $teachertoadminmsg->email=$request->email;
        $teachertoadminmsg->contact_number=$request->contact_number;
        $teachertoadminmsg->teacherid=$request->teacherid;
        $teachertoadminmsg->subject=$request->subject;
        $teachertoadminmsg->message=$request->message;
        $teachertoadminmsg->save();


         $messageinfo = 'Sub: ' . $teachertoadminmsg->subject . ' Details: ' . $teachertoadminmsg->message;

            $usernumber = '88' . env('Admin_Contact_Number');

            Nexmo::message()->send([
                'to'   => $usernumber,
                'from' => '16105552344',
                'text' => $messageinfo,
            ]);
            
        return $teachertoadminmsg;
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdminToteacherMsg  $teachertoadminMsg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::allows('isAdmin')) {
            return TeacherToAdminMsg::where('teacherid',$id)->orderBy('created_at', 'desc')

                ->paginate(4);
    }
    }
     public function singleteachertoadminmsg($id)
    {
        if (Gate::allows('isAdmin')) {
           return  TeacherToAdminMsg::where('id',$id)->firstOrfail();
        } elseif(Gate::allows('isTeacher')) {
             $teacherid =Auth::user()->teacher->id;
            return  TeacherToAdminMsg::where([
                'id' => $id,
                'teacherid' => $teacherid,
                
            ])->firstOrfail();
        }
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeacherToAdminMsg  $teacherToAdminMsg
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherToAdminMsg $teacherToAdminMsg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TeacherToAdminMsg  $teacherToAdminMsg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeacherToAdminMsg $teacherToAdminMsg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeacherToAdminMsg  $teacherToAdminMsg
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherToAdminMsg $teacherToAdminMsg)
    {
        //
    }
}
