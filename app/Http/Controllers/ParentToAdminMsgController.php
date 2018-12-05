<?php

namespace App\Http\Controllers;

use App\ParentToAdminMsg;
use Auth;
use Gate;
use Illuminate\Http\Request;

class ParentToAdminMsgController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    } /**
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
        $parenttoadminmsg                 = new ParentToAdminMsg;
        $parenttoadminmsg->email          = $request->email;
        $parenttoadminmsg->contact_number = $request->contact_number;
        $parenttoadminmsg->childid        = $request->childid;
        $parenttoadminmsg->subject        = $request->subject;
        $parenttoadminmsg->message        = $request->message;
        $parenttoadminmsg->save();
        return $parenttoadminmsg;
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ParentToAdminMsg  $parentToAdminMsg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::allows('isAdmin')) {
            return ParentToAdminMsg::where('childid', $id)->get();
        }
        elseif (Gate::allows('isParent')) {
            $childs = Auth::user()->parent->childinfos->where('id', $id);
            foreach ($childs as $child) {
                return ParentToAdminMsg::where([          
                    'childid' => $child->id,
                ])->get();
            }
        }
    }
    public function singleparentToadminmsg($id)
    {
       if (Gate::allows('isAdmin')) {
        return ParentToAdminMsg::where('id', $id)->firstOrfail();
    }elseif (Gate::allows('isParent')) {
           $doctortoparentMsg = ParentToAdminMsg::where('id', $id)->firstOrfail();
            $childs           = Auth::user()->parent->childinfos->where('id', $doctortoparentMsg->childid);
            foreach ($childs as $child) {
                return ParentToAdminMsg::where([
                    'id'      => $id,
                    'childid' => $child->id,

                ])->firstOrfail();
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ParentToAdminMsg  $parentToAdminMsg
     * @return \Illuminate\Http\Response
     */
    public function edit(ParentToAdminMsg $parentToAdminMsg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ParentToAdminMsg  $parentToAdminMsg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParentToAdminMsg $parentToAdminMsg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ParentToAdminMsg  $parentToAdminMsg
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParentToAdminMsg $parentToAdminMsg)
    {
        //
    }
}
