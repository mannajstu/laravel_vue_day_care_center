<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\Doctor;
use App\ParentInfo;
use App\Role;
use App\User;
use Auth;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
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
        if (Gate::allows('isAdmin')) {
            $search = \Request::get('q');
            if (!empty($search)) {
                return Teacher::with('user')
                    ->whereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                        $query->orWhere('contact_number', 'like', '%' . $search . '%');
                        $query->orWhere('email', 'like', '%' . $search . '%');
                    })
                    ->orWhere('contact_address', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%')
                    ->paginate(5);
            } else {
                return Teacher::with('user')->paginate(5);
            }
        } else {
            $id     = Auth::id();
            $teacher = Teacher::where('userid', $id)
                ->with('user')
                ->with('childinfos')
                ->firstOrfail();

            return $teacher;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('isAdmin')) {
            return Teacher::with('user')->get();
        }
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

            'teacher_name'    => 'required',
            'teacher_email'   => 'required',
            'contact_number'  => 'required',
            'contact_address' => 'required',

        ]);

        $user = new User;

        $user->name           = $request->teacher_name;
        $user->email          = $request->teacher_email;
        $user->password       = Hash::make('password');
        $user->contact_number = $request->contact_number;
        $user->save();

        $role = Role::where('name', 'teacher')->first();
        // return $role;
        if (empty($role)) {
            $role       = new Role;
            $role->name = "teacher";
            $role->save();
        }
        $user->roles()->attach($role->id);

        $user->addTeacher($user->id, $request->contact_address);
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::allows('isAdmin')) {
        $teacher = Teacher::where('id', $id)
        ->with('childinfos')
        ->with('user')
        ->first();

        return $teacher;
    }
    else{
         $teacherid     = Auth::user()->teacher->id;
        $teacher = Doctor::where('id', $teacherid )
        ->with('childinfos')
        ->with('user')
        ->first();
        return $teacher;
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'teacher_name'    => 'required',
            'teacher_email'   => 'required',
            'contact_number'  => 'required',
            'contact_address' => 'required',

        ]);

         $teacher                =Teacher::findOrfail($id);
            
            $teacher->user->email     = $request->teacher_email;
            $teacher->user->name     = $request->teacher_name;
            $teacher->user->contact_number  = $request->contact_number;
            $teacher->contact_address = $request->contact_address;
            $teacher->save();
            $teacher->user->save();
            return $teacher  ;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('isAdmin')) {

            $teacher = Teacher::where('id', $id)
                ->with('user')
                ->first();
               $user = User::where('id', $teacher->user->id)
               ->first();
               $role = Role::where('name', 'teacher')->get();
               $user->roles()->detach($role);
               // return $user;
            Teacher::destroy($id);

        } else {
            return redirect('/notfound');
        }
    }
}
