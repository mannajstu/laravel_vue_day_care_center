<?php

namespace App\Http\Controllers;

use App\HomeContent;
use Auth;
use Gate;
use Illuminate\Http\Request;

class HomeContentController extends Controller
{
    


    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return HomeContent::all();
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
            'header_content'     => 'required',            
        ]);
        $content =new HomeContent;
        $content->header_content=$request->header_content;
        $content->save();
        return $content;

        
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HomeContent  $homeContent
     * @return \Illuminate\Http\Response
     */
    public function show(HomeContent $homeContent)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HomeContent  $homeContent
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeContent $homeContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HomeContent  $homeContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         if (Gate::allows('isAdmin')) {
            $this->validate($request, [
            'header_content'     => 'required',            
        ]);
        $content =HomeContent::findOrfail($id);
        $content->header_content=$request->header_content;
        $content->save();
        return $content;

    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HomeContent  $homeContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeContent $homeContent)
    {
        //
    }
}
