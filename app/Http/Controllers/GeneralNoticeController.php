<?php

namespace App\Http\Controllers;

use App\GeneralNotice;
use Illuminate\Http\Request;

class GeneralNoticeController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return GeneralNotice::all();
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
            'title'     => 'required',            
            'description'     => 'required',            
        ]);
        $content =new GeneralNotice;
        $content->title=$request->title;
        $content->description=$request->description;
        $content->save();
        return $content;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GeneralNotice  $generalNotice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return GeneralNotice::findOrfail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GeneralNotice  $generalNotice
     * @return \Illuminate\Http\Response
     */
    public function edit(GeneralNotice $generalNotice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GeneralNotice  $generalNotice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'     => 'required',            
            'description'     => 'required',            
        ]);
        $content =GeneralNotice::findOrfail($id);
        $content->title=$request->title;
        $content->description=$request->description;
        $content->save();
        return $content;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GeneralNotice  $generalNotice
     * @return \Illuminate\Http\Response
     */
    public function destroy(GeneralNotice $generalNotice)
    {
        //
    }
}
