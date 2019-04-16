<?php

namespace App\Http\Controllers;

use App\AdminToParentMsg;
use Auth;
use Gate;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class AdminToParentMsgController extends Controller
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
        // return AdminToParentMsg::all();
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

                'childid'       => 'required|numeric',
                'subject'        => 'required|min:3',
                'message'        => 'required|min:3|max:100000',

            ]);
        $admintoparentmsg                 = new AdminToParentMsg;
        $admintoparentmsg->email          = $request->email;
        $admintoparentmsg->contact_number = $request->contact_number;
        $admintoparentmsg->childid        = $request->childid;
        $admintoparentmsg->subject        = $request->subject;
        $admintoparentmsg->message        = $request->message;
        $admintoparentmsg->save();

        $messageinfo = 'Sub: ' . $admintoparentmsg->subject  . ' Details: ' . $admintoparentmsg->message  ;
 
         $usernumber = '88'.$admintoparentmsg->contact_number;
// return $usernumber;
                Nexmo::message()->send([
                    'to'   => $usernumber,
                    'from' => '16105552344',
                    'text' =>  $messageinfo,
                ]);

        return $admintoparentmsg;
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdminToParentMsg  $adminToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::allows('isAdmin')) {
        return AdminToParentMsg::where('childid', $id)
        ->orderBy('created_at','desc')

        ->paginate(4);
    }
        elseif (Gate::allows('isParent')) {
            $childs           = Auth::user()->parent->childinfos->where('id', $id);
            foreach ($childs as $child) {
                return AdminToParentMsg::where([                    
                    'childid' => $child->id,

                ])
                ->orderBy('created_at','desc')
                ->paginate(4);
            }
        }
    }
    public function singleadmintoparentmsg($id)
    {
        if (Gate::allows('isAdmin')) {
            return AdminToParentMsg::where('id', $id)->firstOrfail();
        } elseif (Gate::allows('isParent')) {

            $adminaoparentMsg = AdminToParentMsg::where('id', $id)->firstOrfail();
            $childs           = Auth::user()->parent->childinfos->where('id', $adminaoparentMsg->childid);
            foreach ($childs as $child) {
                return AdminToParentMsg::where([
                    'id'      => $id,
                    'childid' => $child->id,

                ])->firstOrfail();
            }

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdminToParentMsg  $adminToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminToParentMsg $adminToParentMsg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdminToParentMsg  $adminToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminToParentMsg $adminToParentMsg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdminToParentMsg  $adminToParentMsg
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminToParentMsg $adminToParentMsg)
    {
        //
    }
}
