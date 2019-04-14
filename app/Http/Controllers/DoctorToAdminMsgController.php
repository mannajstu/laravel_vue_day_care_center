<?php

namespace App\Http\Controllers;

use App\DoctorToAdminMsg;
use Auth;
use Gate;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

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
    {
        $id = Auth::user()->doctor->id;
        return DoctorToAdminMsg::where('doctorid', $id)
        ->orderBy('created_at', 'desc')

            ->paginate(4);
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
        if (Gate::allows('isDoctor')) {
            $this->validate($request, [

            'email'          => 'required|email',
            'contact_number' => 'required|numeric',

            'doctorid'       => 'required|numeric',
            'subject'        => 'required|min:3',
            'message'        => 'required|min:3|max:100000',

        ]);
        $doctortoadminmsg                 = new DoctorToAdminMsg;
        $doctortoadminmsg->email          = $request->email;
        $doctortoadminmsg->contact_number = $request->contact_number;
        $doctortoadminmsg->doctorid       = $request->doctorid;
        $doctortoadminmsg->subject        = $request->subject;
        $doctortoadminmsg->message        = $request->message;
        $doctortoadminmsg->save();
        
        $messageinfo = 'Sub: ' . $doctortoadminmsg->subject . ' Details: ' . $doctortoadminmsg->message;

            $usernumber = '88' . env('Admin_Contact_Number');

            Nexmo::message()->send([
                'to'   => $usernumber,
                'from' => '16105552344',
                'text' => $messageinfo,
            ]);
        return $doctortoadminmsg;
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdminToDoctorMsg  $doctortoadminMsg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::allows('isAdmin')) {
            return DoctorToAdminMsg::where('doctorid', $id)
            ->orderBy('created_at', 'desc')

            ->paginate(4);
    }
    }
    public function singledoctortoadminmsg($id)
    {
        if (Gate::allows('isAdmin')) {
            return DoctorToAdminMsg::where('id', $id)->firstOrfail();
        } elseif (Gate::allows('isDoctor')) {
            $doctorid = Auth::user()->doctor->id;
            return DoctorToAdminMsg::where([
                'id'       => $id,
                'doctorid' => $doctorid,

            ])->firstOrfail();
        }

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
