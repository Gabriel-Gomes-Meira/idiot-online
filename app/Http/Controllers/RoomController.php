<?php

namespace App\Http\Controllers;

use App\Broadcasting\RoomChannel;
use App\Events\BroadcastRoom;
use App\Models\Room;
use Carbon\Traits\Timestamp;
use Illuminate\Broadcasting\BroadcastEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();

        if($rooms){
            // $roomson = DB::table('rooms')->whereNull('winner')->get();
            $roomson = DB::select('select id, name from rooms where winner is null');
        }
        else{
            return (0);
        }

        return response()->json([
            "rooms" => $roomson
        ]);
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
        $qplay = 1;

        $created =Room::create([
            "name" => $request->input("name"),
            "password" => $request->input("password"),
            "qtdplayer" => $qplay
        ]);


        return response()->json([
            'created' => $created
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
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
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }
}
