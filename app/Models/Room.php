<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Room extends Model
{

    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'password',
        'winner',
        'player1',
        'player2'
    ];

    protected $hidden = [
        'password'
    ];

}
