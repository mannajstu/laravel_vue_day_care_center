<?php

namespace App\Http\Controllers;

use App\ParentInfo;
use App\Role;
use App\User;
use Auth;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ParentInfoController extends Controller
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
        if (Gate::allows('isAdmin')) {
            $search = \Request::get('q');
            if (!empty($search)) {
                return ParentInfo::with('user')
                ->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                    $query->orWhere('contact_number', 'like', '%' . $search . '%');
                     })
                    ->orWhere('mother_name', 'like', '%' . $search . '%')
                    ->orWhere('contact_address', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%')
                    ->paginate(5);
            } else {
                return ParentInfo::with('user')->paginate(5);
            }

        } else {
            $id     = Auth::id();
            $parent = ParentInfo::where('userid', $id)
                ->with('user')
                ->with('childinfos')
                ->firstOrfail();

            return $parent;
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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

                'mother_name'     => 'required',
                'father_name'     => 'required',
                'email'           => 'required|email|unique:users,email',
                'contact_number'  => 'required|numeric|unique:users,contact_number',
                'contact_address' => 'required',

            ]);

            $user = new User;

            $user->name           = $request->father_name;
            $user->email          = $request->email;
            $user->password       = Hash::make('password');
            $user->contact_number = $request->contact_number;
            $user->save();

            $role = Role::where('name', 'parent')->first();
            // return $role;
            if (empty($role)) {
                $role       = new Role;
                $role->name = "parent";
                $role->save();
            }
            $user->roles()->attach($role->id);

            $user->addParent($user->id,
                $request->contact_address,
                $request->mother_name);
            return $user;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ParentInfo  $parentInfo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $this->authorize('isAdmin');
        if (Gate::allows('isAdmin')) {
            $parent = ParentInfo::where('id', $id)
                ->with('childinfos')
                ->with('user')
                ->first();

            return $parent;
        } else {
            $parentid = Auth::id();
            $parent   = ParentInfo::where('userid', $parentid)
                ->with('childinfos')
                ->with('user')
                ->first();

            return $parent;
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ParentInfo  $parentInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(ParentInfo $parentInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ParentInfo  $parentInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::allows('isAdmin')) {
            $parent = ParentInfo::findOrfail($id);
        } elseif (Gate::allows('isParent')) {
            $userid = Auth::id();
            $parent = ParentInfo::where([
                'id'     => $id,
                'userid' => $userid,

            ])->firstOrfail();
        }
        if (!empty($parent)) {
            $this->validate($request, [

                'mother_name'     => 'required',
                'father_name'     => 'required',

                'contact_address' => 'required',
                'email'           => 'required|email|unique:users,email,' . $parent->user->id,
                'contact_number'  => 'required|numeric|unique:users,contact_number,' . $parent->user->id,

            ]);

            $parent->mother_name          = $request->mother_name;
            $parent->user->email          = $request->email;
            $parent->user->name           = $request->father_name;
            $parent->user->contact_number = $request->contact_number;
            $parent->contact_address      = $request->contact_address;
            $parent->save();
            $parent->user->save();
            return $parent;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ParentInfo  $parentInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('isAdmin')) {

            $parent = ParentInfo::where('id', $id)
                ->with('user')
                ->first();
               $user = User::where('id', $parent->user->id)
               ->first();
               $role = Role::where('name', 'parent')->get();
               $user->roles()->detach($role);
               // return $user;
            ParentInfo::destroy($id);

        } else {
            return redirect('/notfound');
        }
    }
}
