<?php

namespace App\Http\Controllers;

use App\Gallery;
use File;
use Gate;
use Illuminate\Http\Request;

class GalleryController extends Controller
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
                return Gallery::Where('title', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%')
                    ->paginate(5);
            } else {
                return Gallery::paginate(5);
            }

        } else {
            return Gallery::paginate(5);
        }

    }
    public function slider()
    {
        return Gallery::where('slider', 1)->get();
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
                'title' => 'required',
                'image' => 'required | mimes:jpeg,jpg,png | max:2000',

            ]);

            $gallery = new Gallery;
            if ($request->hasFile('image')) {

                $file = $request->file('image');

                $fileName           = time() . $file->getClientOriginalName();
                $gallery->title     = $request->title;
                $gallery->imagelink = '/uploads/' . $fileName;
                if (!empty($request->slider)) {
                    $gallery->slider = 1;
                } else {
                    $gallery->slider = 0;
                }
                $file->move('uploads', $fileName);
                $gallery->save();
                return $gallery;

            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Gallery::findOrfail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::allows('isAdmin')) {
            $this->validate($request, [
                'title' => 'required',
                'image' => 'required| mimes:jpeg,jpg,png | max:2000',

            ]);

            $gallery = Gallery::findOrfail($id);
            // $gallery->title     = $request->title;
            // $gallery->save();
            return $gallery;
//         if ($request->hasFile('image')) {

//             $file = $request->file('image');
            //             unlink($request->imagelink);

//             $fileName           = time() . $file->getClientOriginalName();
            //             $gallery->title     = $request->title;
            //             $gallery->imagelink = '/uploads/' . $fileName;
            //             if (!empty($request->slider)) {
            //                 $gallery->slider = 1;
            // }
            //                 else{
            //                     $gallery->slider = 0;
            //                 }
            //                 $file->move('uploads', $fileName);
            //                 $gallery->save();
            //                 return $gallery;

//             }
            //             else{
            // return 'fail';
            //             }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('isAdmin')) {

            $gallery = Gallery::where('id', $id)->first();

            $path = public_path() . $gallery->imagelink;

            unlink($path);
            Gallery::destroy($id);
            return $gallery;

        } else {
            return redirect('/notfound');
        }
    }
}
