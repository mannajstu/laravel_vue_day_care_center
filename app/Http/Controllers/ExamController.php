<?php

namespace App\Http\Controllers;

use App\Exam;
use App\User;
use Auth;
use Gate;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class ExamController extends Controller
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
                return Exam::Where('id', 'like', '%' . $search . '%')
                    ->orWhere('exam_title', 'like', '%' . $search . '%')
                    ->orWhere('exam_title', 'like', '%' . $search . '%')
                    ->orWhere('exam_date', 'like', '%' . $search . '%')
                    ->orWhere('exam_time', 'like', '%' . $search . '%')
                    ->paginate(5);
            } else {
                return Exam::paginate(5);
            }
        }
    }

    public function childexaminfo($id)
    {
        if (Gate::allows('isAdmin')) {

            return Exam::with('classinfo.childinfos')->whereHas('classinfo.childinfos', function ($query) use ($id) {
                $query->where('id', $id);
            })->orderBy('created_at', 'desc')

                ->paginate(5);
        } {
            if (Gate::allows('isParent')) {
                $parentid = Auth::user()->parent->id;

                // return ChildInfo::where([
                //     'id'       => $id,
                //     'parentid' => $parentid,

                // ])->with('classinfo.exams')->orderBy('created_at', 'desc')

                //     ->paginate(5);
                return Exam::with('classinfo.childinfos')->whereHas('classinfo.childinfos', function ($query) use ($id, $parentid) {
                    $query->where([
                        'id'       => $id,
                        'parentid' => $parentid,
                    ]);
                })->orderBy('created_at', 'desc')

                    ->paginate(5);
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

        if (Gate::allows('isAdmin')) {
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if (Gate::allows('isAdmin')) {
            $exam = Exam::where('id', $id)->with('classinfo.childinfos')->first();

            return $exam;
        }
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

            // $useremail         = array();
            // $usercontactnumber = array();
            $examinfo = 'Exam ID: ' . $exam->id . ' Date: ' . $exam->exam_date . ' Time: ' . $exam->exam_time . ' Class: ' . $exam->class_number;
            // return $examinfo;
            foreach ($users as $user) {
                // $useremail[]         = $user->email;
                // $usercontactnumber[] = $user->contact_number;
                $usernumber = '88' . $user->contact_number;

                Nexmo::message()->send([
                    'to'   => $usernumber,
                    'from' => '16105552344',
                    'text' => $examinfo,
                ]);
            };
            // $email=['manna.jstu@gmail.com','waleur.jessore@gmail.com'];
            // $examinfo = Exam::findorfail($request->id)->toArray();
            // Mail::send('exammail', ["data" => $examinfo], function ($message) use ($useremail) {
            //     $message->to($useremail)->subject('Exam Notification');
            //     $message->from('admin@gmail.com', 'Day Care Center');
            // });
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
        if (Gate::allows('isAdmin')) {
            $this->validate($request, [
                'exam_title'       => 'required',
                'exam_description' => 'required',
                'exam_date'        => 'required',
                'exam_time'        => 'required',
                'exam_mark'        => 'required',

            ]);

            $exam                   = Exam::find($id);
            $exam->exam_title       = $request->exam_title;
            $exam->exam_description = $request->exam_description;
            $exam->exam_date        = $request->exam_date;
            $exam->exam_time        = $request->exam_time;
            $exam->exam_mark        = $request->exam_mark;
            $exam->save();
            return $exam;
        }
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
