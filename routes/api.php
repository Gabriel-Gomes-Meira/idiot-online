<?php

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('user', 'AuthController@me');

});


Route::post('/register', 'App\Http\Controllers\Usercontroller@store');

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
