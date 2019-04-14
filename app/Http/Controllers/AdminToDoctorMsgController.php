<?php

namespace App\Http\Controllers;

use App\AdminToDoctorMsg;
use Auth;
use Gate;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class AdminToDoctorMsgController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('isDoctor')) {
            $id = Auth::user()->doctor->id;
            return AdminToDoctorMsg::where('doctorid', $id)->orderBy('created_at', 'desc')

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

                'doctorid'       => 'required|numeric',
                'subject'        => 'required|min:3',
                'message'        => 'required|min:3|max:100000',

            ]);
            $admintodoctormsg                 = new AdminToDoctorMsg;
            $admintodoctormsg->email          = $request->email;
            $admintodoctormsg->contact_number = $request->contact_number;
            $admintodoctormsg->doctorid       = $request->doctorid;
            $admintodoctormsg->subject        = $request->subject;
            $admintodoctormsg->message        = $request->message;
            $admintodoctormsg->save();
            return $admintodoctormsg;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdminToDoctorMsg  $adminToDoctorMsg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::allows('isAdmin')) {
            return AdminToDoctorMsg::where('doctorid', $id)->orderBy('created_at', 'desc')

                ->paginate(4);
        }
    }
    public function singleadmintodoctormsg($id)
    {
        if (Gate::allows('isAdmin')) {
            return AdminToDoctorMsg::where('id', $id)->firstOrfail();
        } elseif (Gate::allows('isDoctor')) {
            $doctorid = Auth::user()->doctor->id;
            return AdminToDoctorMsg::where([
                'id'       => $id,
                'doctorid' => $doctorid,

            ])->firstOrfail();
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdminToDoctorMsg  $adminToDoctorMsg
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminToDoctorMsg $adminToDoctorMsg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdminToDoctorMsg  $adminToDoctorMsg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminToDoctorMsg $adminToDoctorMsg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdminToDoctorMsg  $adminToDoctorMsg
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminToDoctorMsg $adminToDoctorMsg)
    {
        //
    }
}
