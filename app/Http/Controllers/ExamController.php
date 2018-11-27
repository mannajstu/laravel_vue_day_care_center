<?php

namespace App\Http\Controllers;

use App\Exam;
use App\User;
use Gate;
use Illuminate\Http\Request;

class ExamController extends Controller
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
        return Exam::all();
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
            'exam_title'       => 'required',
            'exam_description' => 'required',
            'exam_date'        => 'required',
            'exam_time'        => 'required',
            'class_number'     => 'required',

        ]);
        $exam                   = new Exam;
        $exam->exam_title       = $request->exam_title;
        $exam->exam_description = $request->exam_description;
        $exam->exam_date        = $request->exam_date;
        $exam->exam_time        = $request->exam_time;
        $exam->exam_mark        = $request->exam_mark;
        $exam->class_number     = $request->class_number;
        $exam->save();
        return $exam;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $exam = Exam::where('id', $id)->with('classinfo.childinfos')->first();

        return $exam;
    }
    public function notifyinfo(Request $request)
    {

        if (Gate::allows('isAdmin')) {
            $exam = Exam::where('id', $request->id)->with('classinfo.childinfos.parentinfo')->first();

            $child = array();
            $ild   = array();
            foreach ($exam->classinfo->childinfos as $childinfo) {
                $child[] = $childinfo->parentinfo;

            }
            foreach ($child as $childs) {
                $ild[] = $childs->userid;
            }
            $users = User::findOrfail($ild);

            $useremail         = array();
            $usercontactnumber = array();
            foreach ($users as $user) {
                $useremail[]         = $user->email;
                $usercontactnumber[] = $user->contact_number;
            }
            return $useremail;
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'exam_title'       => 'required',
            'exam_description' => 'required',
            'exam_date'        => 'required',
            'exam_time'        => 'required',

        ]);

        $exam                   = Exam::find($id);
        $exam->exam_title       = $request->exam_title;
        $exam->exam_description = $request->exam_description;
        $exam->exam_date        = $request->exam_date;
        $exam->exam_time        = $request->exam_time;
        $exam->save();
        return $exam;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
