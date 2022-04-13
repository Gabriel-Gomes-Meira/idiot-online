<?php

use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



Route::post('/teste', function () {
    return response()->json([
        'message' => "CHEGOU AQUI",
    ], 200);
});

Route::get('user', 'AuthController@me')->middleware('auth:sanctum');
Route::post('/register', 'Usercontroller@store');

Route::get('/room','RoomController@index')->middleware('auth:sanctum');
Route::post('/room/create', 'RoomController@store')->middleware('auth:sanctum');
Route::post('/room/enter', 'RoomController@enter')->middleware('auth:sanctum');


Route::get('/baralho','Baralhocontroller@index')->middleware('auth:sanctum');

// Route::post('/room/closed/{id}', 'App\Http\Controllers\RoomController@update');
