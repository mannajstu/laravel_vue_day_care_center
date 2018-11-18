<?php

namespace App\Http\Controllers;

use App\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
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

        ]);
        $exam = new Exam;
        $exam->exam_title=$request->exam_title;
        $exam->exam_description=$request->exam_description;
        $exam->exam_date=$request->exam_date;
        $exam->exam_time=$request->exam_time;
        $exam->exam_mark=$request->exam_mark;
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
        return Exam::findOrfail($id)->first();
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

        $exam = Exam::find($id);
        $exam->exam_title=$request->exam_title;
        $exam->exam_description=$request->exam_description;
        $exam->exam_date=$request->exam_date;
        $exam->exam_time=$request->exam_time;
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
