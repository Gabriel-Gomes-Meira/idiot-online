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

    public static $rules = array(
        'name' => 'required',
        'winner' => 'exists:App\Room,player1,player2',
        'player1' => 'required | exists:App\User,id',
        'player2' => 'exists:App\User,id',
        'password' => 'required'
    );

    public static $messages = array(
        'name.required' => "Necessário 'nome' da sala",
        'player1.required' => "Necessário 'jogador 1' da sala!",
        'player1.exists' => "Necessário que 'jogador 1' já tenha sido registrado!",
        'player2.exists' => "Necessário que 'jogador 2' já tenha sido registrado!",
        'password.required' => "Necessário 'senha' da sala!",
        'winner' => "Usuário vencedor inválido!!"
    );

    protected $hidden = [
        'password'
    ];

}
