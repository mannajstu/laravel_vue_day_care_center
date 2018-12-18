<?php

namespace App\Http\Controllers;

use App\DoctorToParentMsg;
use Auth;
use Gate;
use Illuminate\Http\Request;

class DoctorToParentMsgController extends Controller
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
        if (Gate::allows('isDoctor')) {
            $this->validate($request, [

                'email'          => 'required|email',
                'contact_number' => 'required|numeric',

                'childid'        => 'required|numeric',
                'subject'        => 'required|min:3',
                'message'        => 'required|min:3|max:100000',

            ]);
            $doctortoparentmsg                 = new DoctorToParentMsg;
            $doctortoparentmsg->email          = $request->email;
            $doctortoparentmsg->contact_number = $request->contact_number;
            $doctortoparentmsg->childid        = $request->childid;
            $doctortoparentmsg->subject        = $request->subject;
            $doctortoparentmsg->message        = $request->message;
            $doctortoparentmsg->save();
            return $doctortoparentmsg;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DoctorToParentMsg  $doctorToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::allows('isAdmin')) {
            return DoctorToParentMsg::where('childid', $id)->orderBy('created_at', 'desc')

                ->paginate(4);
        } elseif (Gate::allows('isParent')) {
            $childs = Auth::user()->parent->childinfos->where('id', $id);
            foreach ($childs as $child) {
                return DoctorToParentMsg::where([
                    'childid' => $child->id,
                ])->orderBy('created_at', 'desc')

                    ->paginate(4);
            }
        } elseif (Gate::allows('isDoctor')) {
            $childs = Auth::user()->doctor->childinfos->where('id', $id);
            foreach ($childs as $child) {
                return DoctorToParentMsg::where([
                    'childid' => $child->id,
                ])->orderBy('created_at', 'desc')

                    ->paginate(4);
            }
        }
    }
    public function singledoctortoparentmsg($id)
    {
        if (Gate::allows('isAdmin')) {
            return DoctorToParentMsg::where('id', $id)->firstOrfail();
        } elseif (Gate::allows('isParent')) {
            $doctortoparentMsg = DoctorToParentMsg::where('id', $id)->firstOrfail();
            $childs            = Auth::user()->parent->childinfos->where('id', $doctortoparentMsg->childid);
            foreach ($childs as $child) {
                return DoctorToParentMsg::where([
                    'id'      => $id,
                    'childid' => $child->id,

                ])->firstOrfail();
            }
        } elseif (Gate::allows('isDoctor')) {
            $doctortoparentMsg = DoctorToParentMsg::where('id', $id)->firstOrfail();
            $childs            = Auth::user()->doctor->childinfos->where('id', $doctortoparentMsg->childid);
            foreach ($childs as $child) {
                return DoctorToParentMsg::where([
                    'id'      => $id,
                    'childid' => $child->id,

                ])->firstOrfail();
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DoctorToParentMsg  $doctorToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function edit(DoctorToParentMsg $doctorToParentMsg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DoctorToParentMsg  $doctorToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoctorToParentMsg $doctorToParentMsg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DoctorToParentMsg  $doctorToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorToParentMsg $doctorToParentMsg)
    {
        //
    }
}
