<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', 'App\Http\Controllers\AuthController@adminv');

Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::get('/admin', 'App\Http\Controllers\AuthController@adminv')->name('admin');
    // cards
    Route::get('/admin/baralho', 'App\Http\Controllers\AuthController@baralho')->name('baralho');
        Route::post('/admin/baralho/add', 'App\Http\Controllers\BaralhoController@store')->name('cardadd');
        Route::post('/admin/baralho/update/{id}', 'App\Http\Controllers\BaralhoController@update')->name('cardup');
        Route::post('/admin/baralho/delete/{id}', 'App\Http\Controllers\BaralhoController@destroy')->name('carddel');

    // salas
    Route::get('/admin/rooms','App\Http\Controllers\AuthController@rooms')->name('rooms');

    // users
    Route::get('/admin/users','App\Http\Controllers\AuthController@users')->name('users');
