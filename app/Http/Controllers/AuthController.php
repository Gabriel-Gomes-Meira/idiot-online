<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;

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
}
