<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RoomController extends Controller
{

    public function index()
    {
        $rooms = Room::all();

        if($rooms){
            $roomson = DB::select('select id, name, qtdplayer from rooms where winner is null order by id desc');
        }
        else{
            return (0);
        }


        return response()->json([
            "rooms" => $roomson
        ]);
    }

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

    public function update(Request $request, $id)
    {
        $foundroom = Room::find($id);

        if($request->winner){
            $foundroom->winner = $request->winner;
            $foundroom->save();
        }
        else{
            $foundroom->delete();
        }

        return response()->json([
            'message' => 'created'
        ], 200);
    }
}
