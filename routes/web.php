<?php


use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Broadcast;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/enviaevento/{id}', function ($id) {
    return event(new \App\Events\BroadcastRoom('Uai só...', $id));
});

Broadcast::routes(['middleware' => ['auth:api']]);

Route::post('/broadcasting/auth', 'Illuminate\Broadcasting\BroadcastController@authenticate');


