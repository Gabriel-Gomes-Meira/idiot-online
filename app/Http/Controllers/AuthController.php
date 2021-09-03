<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function adminv()
    {
        if(Auth::check() === true){
            return view('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credenciais = [
            "email" => $request->email,
            "password" =>$request->password,
            "admin" => 1
        ];

        if(Auth::attempt($credenciais)){
            return view('admin.dashboard');
        }

        return redirect()->back()->withInput()->withErrors(['Dados inválidos!!']);

    }

    public function baralho()
    {
        $cards = Card::all();
        return view('admin.dashboard.cards', compact('cards'));
    }

    public function rooms()
    {
        $Rooms = DB::select(
        'Select r.*, u.name as hoster, u2.name as guester, uw.name as winner from rooms r
            inner join users u on (u.id = r.player1)
            left join users u2 on(u2.id = r.player2)
            left join users uw on (uw.id = r.winner)
            order by r.id desc');
        return view('admin.dashboard.rooms', compact('Rooms'));
    }

    public function users()
    {
        $Users = User::where('admin', false)->get();
        $Users = collect($Users)->except('admin');
        return view('admin.dashboard.users', compact('Users'));
    }
}
