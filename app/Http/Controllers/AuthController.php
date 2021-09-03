<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\Card;
// use App\Models\User;
// use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // Dashboard do back-end está pra ser passado pro front... Algum dia...
    // public function adminv()
    // {
    //     if(Auth::check() === true){
    //         return view('admin.dashboard');
    //     }

    //     return view('admin.login');
    // }

    // public function login(Request $request)
    // {
    //     $credenciais = [
    //         "email" => $request->email,
    //         "password" =>$request->password,
    //         "admin" => 1
    //     ];

    //     if(Auth::attempt($credenciais)){
    //         return view('admin.dashboard');
    //     }

    //     return redirect()->back()->withInput()->withErrors(['Dados inválidos!!']);

    // }

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

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(Auth::user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();


        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], 200);
    }
}
