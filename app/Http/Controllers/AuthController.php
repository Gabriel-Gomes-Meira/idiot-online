<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // public function adminv()
    // {
    //     if(Auth::check() === true){
    //         return view('admin.dashboard');
    //     }

    //     return view('admin.login');
    // }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return $request->session()->regenerate();
        }

        return response()->json([
            'message' => 'Invalid login details'
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }

    public function me(Request $request)
    {
        return response()->json([
            'data' => $request->user(),
        ]);
    }

    // public function baralho()
    // {
    //     $cards = Card::all();
    //     return view('admin.dashboard.cards', compact('cards'));
    // }

    // public function rooms()
    // {
    //     $Rooms = DB::select(
    //     'Select r.*, u.name as hoster, u2.name as guester, uw.name as winner from rooms r
    //         inner join users u on (u.id = r.player1)
    //         left join users u2 on(u2.id = r.player2)
    //         left join users uw on (uw.id = r.winner)
    //         order by r.id desc');
    //     return view('admin.dashboard.rooms', compact('Rooms'));
    // }

    // public function users()
    // {
    //     $Users = User::where('admin', false)->get();
    //     $Users = collect($Users)->except('admin');
    //     return view('admin.dashboard.users', compact('Users'));
    // }
}
