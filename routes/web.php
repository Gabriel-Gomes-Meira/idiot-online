<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/', 'AuthController@adminv');

Route::post('/login', 'AuthController@login')->name('login');
Route::post('/logout', 'AuthController@logout')->name('logout');
// Route::post('/room/create', 'RoomController@store')->name('create');
// Route::get('/admin', 'AuthController@adminv')->name('admin');

//     // cards
//     Route::get('/admin/baralho', 'AuthController@baralho')->name('baralho');
//         Route::post('/admin/baralho/add', 'BaralhoController@store')->name('cardadd');
//         Route::post('/admin/baralho/update/{id}', 'BaralhoController@update')->name('cardup');
//         Route::post('/admin/baralho/delete/{id}', 'BaralhoController@destroy')->name('carddel');

//     // salas
//     Route::get('/admin/rooms','AuthController@rooms')->name('rooms');

//     // users
//     Route::get('/admin/users','AuthController@users')->name('users');
