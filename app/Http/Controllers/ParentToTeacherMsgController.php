<?php

namespace App\Http\Controllers;

use App\ParentToTeacherMsg;
use Auth;
use Gate;
use Illuminate\Http\Request;

class ParentToTeacherMsgController extends Controller
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

                'childid'       => 'required|numeric',
                'subject'        => 'required|min:3',
                'message'        => 'required|min:3|max:100000',

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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Parenttoteachermsg  $parenttoteachermsg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::allows('isAdmin')) {
            return ParenttoTeacherMsg::where('childid', $id)->get();
        } elseif (Gate::allows('isParent')) {
            $childs = Auth::user()->parent->childinfos->where('id', $id);
            foreach ($childs as $child) {
                return ParenttoTeacherMsg::where([
                    'childid' => $child->id,
                ])->get();
            }
        } elseif (Gate::allows('isTeacher')) {
            $childs = Auth::user()->teacher->childinfos->where('id', $id);
            foreach ($childs as $child) {
                return ParenttoTeacherMsg::where([
                    'childid' => $child->id,
                ])->get();
            }
        }
    }
    public function singleparenttoteachermsg($id)
    {
        if (Gate::allows('isAdmin')) {
            return ParenttoTeacherMsg::where('id', $id)->firstOrfail();
        }
        elseif (Gate::allows('isParent')) {
           $parenttoteacherMsg = ParenttoTeacherMsg::where('id', $id)->firstOrfail();
            $childs           = Auth::user()->parent->childinfos->where('id', $parenttoteacherMsg->childid);
            foreach ($childs as $child) {
                return ParenttoTeacherMsg::where([
                    'id'      => $id,
                    'childid' => $child->id,

                ])->firstOrfail();
            }
        }
        elseif (Gate::allows('isTeacher')) {
           $parenttoteacherMsg = ParenttoTeacherMsg::where('id', $id)->firstOrfail();
            $childs           = Auth::user()->teacher->childinfos->where('id', $parenttoteacherMsg->childid);
            foreach ($childs as $child) {
                return ParenttoTeacherMsg::where([
                    'id'      => $id,
                    'childid' => $child->id,

                ])->firstOrfail();
            }
        }
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
