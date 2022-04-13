<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class RoomController extends Controller
{

    public function index()
    {
        $rooms = Room::all();

        if($rooms){
            $roomson = DB::select('select r.id as idroom, r.name, u.name as player1, r.created_at from rooms r
            inner join users u on (u.id = r.player1) where winner is null order by created_at desc');
        }
        else{
            return (0);
        }

        return response()->json([
            "rooms" => $roomson
        ]);
    }

    public function teste() {
        return response()->json([
            'message' => "CHEGOU AQUI",
        ], 200);
    }

    public function store(Request $request)
    {
        $created =Room::create([
            "name" => $request->input("name"),
            "password" => $request->input("password"),
            "player1" => Auth::user()->id
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

    public function enter(Request $request) {

        $targetroom = Room::find($request->idroom);

        if( $targetroom->password == $request->password && !$targetroom->player2){
            $targetroom->player2 = Auth::user()->id;
            $targetroom->save();
            return response([
                'message' => "O jogo irá começar.",
                'confirm' => '0',
            ], 200);
        }

        else{
            return response([
                'message' => "Sala já ocupada, ou senha incorreta",
                'confirm' => '1',
            ], 200);
        }
    }
}
