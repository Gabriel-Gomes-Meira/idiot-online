<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        // return response()->json([
        //     "created" => dd($request)
        // ], 200);
        try {
            $created = User::create([
                "name" => $request->input("name"),
                "email" => $request->input("email"),
                "password" => Hash::make($request->input("password")),
                "admin" => false
            ]);

            return response()->json([
                "created" => $created
            ], 200);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function update(Request $request, User $user)
    {
        //
    }


    public function destroy(User $user)
    {
        //
    }
}
