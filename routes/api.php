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
    try {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['Não há usuário registrado com esses dados.']
            ], 404);
        }

        $token = $user->createToken('idiot-online-token')->plainTextToken;
        $user = collect($user)->except('admin');


        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
        //code...
    } catch (\Throwable $th) {
        return $th;
    }

});

Route::post('/users/add', 'App\Http\Controllers\Usercontroller@store');

Route::get('/room','App\Http\Controllers\Roomcontroller@index');

Route::get('/baralho','App\Http\Controllers\Baralhocontroller@index');

Route::post('/room/create', 'App\Http\Controllers\RoomController@store');

Route::post('/room/enter/{id}', function (Request $request, $id) {

        $targetroom = Room::find($id);

        if( $targetroom->password == $request->input('password') && !$targetroom->player2){
            $targetroom->player2 = $request->player2;
            $targetroom->save();
            return response([
                'message' => "conected",
                'confirm' => '0',
                200
            ]);
        }

        else{
            return response([
                'message' => "Sala já ocupada, ou senha incorreta",
                'confirm' => '1',
                404
            ]);
        }


});

Route::post('/room/closed/{id}', 'App\Http\Controllers\RoomController@update');
