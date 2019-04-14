<?php

namespace App\Http\Controllers;

use App\ParentToDoctorMsg;
use Gate;
use Auth;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class ParentToDoctorMsgController extends Controller
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
        if (Gate::allows('isParent')) {
            $this->validate($request, [

                'email'          => 'required|email',
                'contact_number' => 'required|numeric',

                'childid'        => 'required|numeric',
                'subject'        => 'required|min:3',
                'message'        => 'required|min:3|max:100000',

            ]);
            $parenttodoctormsg                 = new ParentToDoctorMsg;
            $parenttodoctormsg->email          = $request->email;
            $parenttodoctormsg->contact_number = $request->contact_number;
            $parenttodoctormsg->childid        = $request->childid;
            $parenttodoctormsg->subject        = $request->subject;
            $parenttodoctormsg->message        = $request->message;
            $parenttodoctormsg->save();

            $messageinfo = 'Sub: ' . $parenttodoctormsg->subject . ' Details: ' . $parenttodoctormsg->message;

            $usernumber = '88' . $parenttodoctormsg->contact_number;

            Nexmo::message()->send([
                'to'   => $usernumber,
                'from' => '16105552344',
                'text' => $messageinfo,
            ]);
            
            return $parenttodoctormsg;
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\ParentTodoctormsg  $parentTodoctormsg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::allows('isAdmin')) {
            return ParentToDoctorMsg::where('childid', $id)->orderBy('created_at', 'desc')

                ->paginate(4);
        }elseif (Gate::allows('isParent')) {
            $childs = Auth::user()->parent->childinfos->where('id', $id);
            foreach ($childs as $child) {
                return ParentToDoctorMsg::where([          
                    'childid' => $child->id,
                ])->orderBy('created_at', 'desc')

                ->paginate(4);
            }
        }
        elseif (Gate::allows('isDoctor')) {
            $childs = Auth::user()->doctor->childinfos->where('id', $id);
            foreach ($childs as $child) {
                return ParentToDoctorMsg::where([          
                    'childid' => $child->id,
                ])->orderBy('created_at', 'desc')

                ->paginate(4);
            }
        }
    }
    public function singleparenttodoctormsg($id)
    {
        if (Gate::allows('isAdmin')) {
            return ParentToDoctorMsg::where('id', $id)->firstOrfail();
        }elseif (Gate::allows('isParent')) {
           $doctortoparentMsg = ParentToDoctorMsg::where('id', $id)->firstOrfail();
            $childs           = Auth::user()->parent->childinfos->where('id', $doctortoparentMsg->childid);
            foreach ($childs as $child) {
                return ParentToDoctorMsg::where([
                    'id'      => $id,
                    'childid' => $child->id,

                ])->firstOrfail();
            }
        }
        elseif (Gate::allows('isDoctor')) {
           $doctortoparentMsg = ParentToDoctorMsg::where('id', $id)->firstOrfail();
            $childs           = Auth::user()->doctor->childinfos->where('id', $doctortoparentMsg->childid);
            foreach ($childs as $child) {
                return ParentToDoctorMsg::where([
                    'id'      => $id,
                    'childid' => $child->id,

                ])->firstOrfail();
            }
        }
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
