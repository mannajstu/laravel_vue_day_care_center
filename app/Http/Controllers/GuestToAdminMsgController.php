<?php

namespace App\Http\Controllers;

use App\GuestToAdminMsg;
use Auth;
use Gate;
use Illuminate\Http\Request;

class GuestToAdminMsgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('isAdmin')){
            
        


        $search = \Request::get('q');
            if (!empty($search)) {

                $child = GuestToAdminMsg::
                    Where('id', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('subject', 'like', '%' . $search . '%')
                    ->orWhere('contact_number', 'like', '%' . $search . '%')
->orderBy('created_at', 'desc')
                    ->paginate(50);
                return $child;
            } else {
              return GuestToAdminMsg::orderBy('created_at', 'desc')->paginate(5);
            }
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
         $this->validate($request, [

                'email'          => 'required|email',
                'contact_number' => 'required|numeric|digits_between:6,20',

                'subject'        => 'required|min:3',
                'message'        => 'required|min:3|max:100000',

            ]);
            $guesttoadminmsg                 = new GuestToAdminMsg;
            $guesttoadminmsg->email          = $request->email;
            $guesttoadminmsg->contact_number = $request->contact_number;
            
            $guesttoadminmsg->subject        = $request->subject;
            $guesttoadminmsg->message        = $request->message;
            $guesttoadminmsg->save();
            return $guesttoadminmsg;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GuestToAdminMsg  $guestToAdminMsg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Gate::allows('isParent')){
            return GuestToAdminMsg::where('id',$id)
            ->paginate(5);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GuestToAdminMsg  $guestToAdminMsg
     * @return \Illuminate\Http\Response
     */
    public function edit(GuestToAdminMsg $guestToAdminMsg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GuestToAdminMsg  $guestToAdminMsg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GuestToAdminMsg $guestToAdminMsg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GuestToAdminMsg  $guestToAdminMsg
     * @return \Illuminate\Http\Response
     */
    public function destroy(GuestToAdminMsg $guestToAdminMsg)
    {
        //
    }
}
