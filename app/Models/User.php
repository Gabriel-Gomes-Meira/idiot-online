<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin'
    ];

    public static $rules = array(
        'name' => 'required',
        'email' => 'required | unique:App\User,email',
        'password' => 'required'
    );

    public static $messages = array(
        'name.required' => "Necessário 'nome' para que um usuário seja criado!",
        'email.required' => "Necessário 'e-mail' para que um usuário seja criado!",
        'password.required' => "Necessário 'senha' para que um usuário seja criado!",
    );

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];
}
