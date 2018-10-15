<?php

namespace App\Http\Controllers;

use App\ParentInfo;
use Illuminate\Http\Request;

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
        return ParentInfo::all();
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
        $this->validate($request, [
            
            'mother_name'     => 'required',
            'father_name'     => 'required',
            'contact_number'  => 'required',
            'contact_address' => 'required',
            
        ]);

         $parent                  = new ParentInfo;
            $parent->mother_name     = $request->mother_name;
            $parent->father_name     = $request->father_name;
            $parent->contact_number  = $request->contact_number;
            $parent->contact_address = $request->contact_address;
            $parent->save();
            return $parent;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ParentInfo  $parentInfo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parent = ParentInfo::where('id', $id)->with('childinfos')->first();

        return $parent;
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
         $this->validate($request, [
            
            'mother_name'     => 'required',
            'father_name'     => 'required',
            'contact_number'  => 'required',
            'contact_address' => 'required',
            
        ]);

            $parent                =ParentInfo::findOrfail($id);
            $parent->mother_name     = $request->mother_name;
            $parent->father_name     = $request->father_name;
            $parent->contact_number  = $request->contact_number;
            $parent->contact_address = $request->contact_address;
            $parent->save();
            return $parent;
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ParentInfo  $parentInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParentInfo $parentInfo)
    {
        //
    }
}
