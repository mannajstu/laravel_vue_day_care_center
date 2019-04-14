<?php

namespace App\Http\Controllers;

use App\TeacherToParentMsg;
use Auth;
use Gate;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class TeacherToParentMsgController extends Controller
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
        if (Gate::allows('isTeacher')) {
             $this->validate($request, [

                'email'          => 'required|email',
                'contact_number' => 'required|numeric',

                'childid'       => 'required|numeric',
                'subject'        => 'required|min:3',
                'message'        => 'required|min:3|max:100000',

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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TeacherToParentMsg  $teacherToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::allows('isAdmin')) {
             return TeacherToParentMsg::where('childid', $id)->orderBy('created_at', 'desc')

                ->paginate(4);
        } elseif (Gate::allows('isParent')) {
            $childs = Auth::user()->parent->childinfos->where('id', $id);
            foreach ($childs as $child) {
                return TeacherToParentMsg::where([          
                    'childid' => $child->id,
                ])->orderBy('created_at', 'desc')

                ->paginate(4);
            }
        }
        elseif (Gate::allows('isTeacher')) {
            $childs = Auth::user()->teacher->childinfos->where('id', $id);
            foreach ($childs as $child) {
                return TeacherToParentMsg::where([
                    'childid' => $child->id,
                     ])->orderBy('created_at', 'desc')

                ->paginate(4);
            }
        }
    }
    public function singleteachertoparentmsg($id)
    {
        if (Gate::allows('isAdmin')) {return TeacherToParentMsg::where('id', $id)->firstOrfail();
    }elseif (Gate::allows('isParent')) {
           $doctortoparentMsg = TeacherToParentMsg::where('id', $id)->firstOrfail();
            $childs           = Auth::user()->parent->childinfos->where('id', $doctortoparentMsg->childid);
            foreach ($childs as $child) {
                return TeacherToParentMsg::where([
                    'id'      => $id,
                    'childid' => $child->id,

                ])->firstOrfail();
            }
        }
        elseif (Gate::allows('isTeacher')) {
            $doctortoparentMsg = TeacherToParentMsg::where('id', $id)->firstOrfail();
            $childs           = Auth::user()->teacher->childinfos->where('id', $doctortoparentMsg->childid);
            foreach ($childs as $child) {
                return TeacherToParentMsg::where([
                    'id'      => $id,
                    'childid' => $child->id,

                ])->firstOrfail();
            }
            }
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
