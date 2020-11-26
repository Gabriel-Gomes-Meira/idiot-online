<?php

use App\Models\User;
use App\Models\Room;
use App\Events\BroadcastRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Broadcast::routes(['middleware' => ['auth:sanctum']]);

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return $request->user();
});

Route::post('/users/login', function (Request $request) {

    $user = User::where('email', $request->email)->first();

    if (!$user || ($request->password != $user->password)) {
        return response([
            'message' => ['These credentials do not match our records.']
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


Route::post('/room/create', 'App\Http\Controllers\Roomcontroller@store');

Route::get('/room','App\Http\Controllers\Roomcontroller@index');

Route::get('/baralho','App\Http\Controllers\Baralhocontroller@index');

Route::post('/baralho/card','App\Http\Controllers\Baralhocontroller@store');

Route::get('/transroom/{id}', function ($id) {
    return event(new BroadcastRoom('veio daqui...',$id));
    //event(new \App\Events\BroadcastRoom('palmeiras não tem mundial',$id));
});

Route::post('/room/enter/{id}', function (Request $request, $id) {
    try {
        $Rooms = Room::all();
        $targetroom = $Rooms->find($id);
        if( $targetroom->password == $request->input('password') && $targetroom->qtdplayer<2){
            DB::table('rooms')
                ->where('id', $id)
                ->update(['qtdplayer' => 2]);

        event(new BroadcastRoom('teste número nove mil!', $targetroom->id));
        return 0;

        }

        else{
            return 0;
        }

    } catch (\Throwable $th) {
        return $th;
    }


});

Route::post('/broadcasting/auth', 'Illuminate\Broadcasting\BroadcastController@authenticate');
