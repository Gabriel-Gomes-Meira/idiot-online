<?php

use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return $request->user();
});

Route::post('/users/login', function (Request $request) {

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response([
            'message' => ['Não há usuário registrado com esses dados.']
        ], 404);
    }

    $token = $user->createToken('idiot-online-token')->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token
    ];

    return response($response, 201);
});

Route::post('/users/add', 'App\Http\Controllers\Usercontroller@store');

Route::get('/room','App\Http\Controllers\Roomcontroller@index');

Route::get('/baralho','App\Http\Controllers\Baralhocontroller@index');

Route::post('/baralho/card','App\Http\Controllers\Baralhocontroller@store');

Route::post('/room/create', 'App\Http\Controllers\Roomcontroller@store');

Route::post('/room/enter/{id}', function (Request $request, $id) {
    try {
        $Rooms = Room::all();
        $targetroom = $Rooms->find($id);
        if( $targetroom->password == $request->input('password') && $targetroom->qtdplayer<2){
            DB::table('rooms')
                ->where('id', $id)
                ->update(['qtdplayer' => 2]);
            return response([
                'message' => "0",
                200
            ]);
        }

        else{
            return response([
                'message' => "1",
                404
            ]);
        }

    } catch (\Throwable $th) {
        return $th;
    }


});

Route::post('/room/closed/{id}', 'RoomController@update');
