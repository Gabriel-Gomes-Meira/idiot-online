<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', 'App\Http\Controllers\AuthController@adminv')->name('admin');
Route::get('/', 'App\Http\Controllers\AuthController@adminv');

Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::get('/admin/baralho', 'App\Http\Controllers\AuthController@baralho')->name('baralho');
    Route::post('/admin/baralho/update/{id}', 'App\Http\Controllers\BaralhoController@update')->name('cardup');
