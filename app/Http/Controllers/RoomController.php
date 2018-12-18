<?php

namespace App\Http\Controllers;

use App\Room;
use Gate;
use Illuminate\Http\Request;

class RoomController extends Controller
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
                return Room::Where('room_number', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%')
                    ->orWhere('room_description', 'like', '%' . $search . '%')
                    ->orWhere('room_capacity', 'like', '%' . $search . '%')
                    ->paginate(5);
            } else {
                $rooms = Room::paginate(5);

                return $rooms;
            }
        }

    }
    public function roomnumber()
    {
        if (Gate::allows('isAdmin')) {
            $rooms = Room::all();
            $rm    = array();
            foreach ($rooms as $room) {
                $rm[] = $room->room_number;
            }
            return $rm;
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

                'room_number'      => 'required|numeric|unique:rooms,room_number',
                'room_capacity'    => 'required|numeric',
                'room_description' => 'required',

            ]);

            $room                   = new Room;
            $room->room_number      = $request->room_number;
            $room->room_capacity    = $request->room_capacity;
            $room->room_description = $request->room_description;
            $room->save();
            return $room;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::allows('isAdmin')) {
            $room = Room::where('room_number', $id)->with('childinfos')->first();

            return $room;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'room_number'      => 'required|numeric|unique:rooms,room_number,' . $id,
            'room_capacity'    => 'required|numeric',
            'room_description' => 'required',

        ]);

        $room = Room::where('id', $id)->first();

        $room->room_number      = $request->room_number;
        $room->room_capacity    = $request->room_capacity;
        $room->room_description = $request->room_description;

        $room->save();

        return $room;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }
}
