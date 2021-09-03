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
            $roomson = DB::select('select id, name, player1, player2 from rooms where winner is null order by created_at desc');
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
        $created =Room::create([
            "name" => $request->input("name"),
            "password" => $request->input("password"),
            "player1" => $request->player1
        ]);


        return response()->json([
            'created' => $created
        ]);

    }

    public function update(Request $request, $id)
    {

        $foundroom = Room::find($id);
        if($foundroom){
            if($request->winner){
                $foundroom->winner = $request->winner;
                $foundroom->save();
            }
            else{
                $foundroom->delete();
            }

            return response()->json([
                'message' => $foundroom
            ], 200);
        }

        else{
            return response()->json([
                'message' => 'Sala não encontrada'
            ], 404);
        }


    }
}
