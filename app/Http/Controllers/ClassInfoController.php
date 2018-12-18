<?php

namespace App\Http\Controllers;

use App\ClassInfo;
use App\ChildInfo;
use Auth;
use Gate;
use Illuminate\Http\Request;

class ClassInfoController extends Controller
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
                return ClassInfo::Where('class_number', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%')
                    ->orWhere('class_description', 'like', '%' . $search . '%')                    
                    ->paginate(5);
            } else {
                $class = ClassInfo::paginate(5);

                return $class;
            }
        }
    }
    public function classnumber()
    {
        if (Gate::allows('isAdmin')) {
             return ClassInfo::all();
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
             return ClassInfo::all();
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
       if (Gate::allows('isAdmin')) {
        $this->validate($request, [

            'class_number'      => 'required',

            'class_description' => 'required',

        ]);

        $class              = new ClassInfo;
        $class->class_number = $request->class_number;

        $class->class_description = $request->class_description;
        $class->save();
        return $class;

    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClassInfo  $classInfo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::allows('isAdmin')) {
            $class = ClassInfo::where('class_number', $id)->with('childinfos')->first();

        return $class;
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClassInfo  $classInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassInfo $classInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClassInfo  $classInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::allows('isAdmin')) {
            $this->validate($request, [

            'class_number'      => 'required|numeric',

            'class_description' => 'required',

        ]);

        $class = ClassInfo::where('id', $id)->first();

        $class->class_number = $request->class_number;

        $class->class_description = $request->class_description;

        $class->save();

        return $class;
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClassInfo  $classInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassInfo $classInfo)
    {
        //
    }
}
