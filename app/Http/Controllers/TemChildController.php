<?php

namespace App\Http\Controllers;

use App\TemChild;
use Illuminate\Http\Request;
use Gate;

class TemChildController extends Controller
{
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

                $child = TemChild::Where('father_name', 'like', '%' . $search . '%')
                    ->orWhere('child_name', 'like', '%' . $search . '%')
                    
                    ->orWhere('birth_date', 'like', '%' . $search . '%')
                    ->orWhere('birth_reg_no', 'like', '%' . $search . '%')
                    ->orWhere('mother_name', 'like', '%' . $search . '%')
                    ->orWhere('contact_number', 'like', '%' . $search . '%')
                    ->orWhere('contact_address', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orderBy('created_at', 'desc')
                    ->paginate(50);
                return $child;
            } else {
                $child = TemChild::paginate(5);
                return $child;
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

            'child_name'      => 'required',

            'birth_date'      => 'required',
            'birth_reg_no'    => 'required|unique:tem_children,birth_reg_no',
            'gender'          => 'required',
            'mother_name'     => 'required',
            'father_name'     => 'required',

            'contact_address' => 'required',
            'email'           => 'required|email',
            'contact_number'  => 'required|numeric',

        ]);
        $child             = new TemChild;
        $child->child_name = $request->child_name;
        

        $child->birth_date   = $request->birth_date;
        $child->birth_reg_no = $request->birth_reg_no;
        $child->gender       = $request->gender;
        $child->mother_name       = $request->mother_name;
        $child->father_name       = $request->father_name;
        $child->email       = $request->email;
        $child->contact_address       = $request->contact_address;
        $child->contact_number      = $request->contact_number;
              
        $child->save();
        return $child;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TemChild  $temChild
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::allows('isAdmin')) {
            $child =TemChild::where("id",$id)->first();
        return $child;
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TemChild  $temChild
     * @return \Illuminate\Http\Response
     */
    public function edit(TemChild $temChild)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TemChild  $temChild
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TemChild $temChild)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TemChild  $temChild
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('isAdmin')) {

            TemChild::destroy($id);

        } else {
            return redirect('/notfound');
        }
    }
}
