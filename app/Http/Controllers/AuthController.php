<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::query()->where('email', $request->input('email'))->first();

        if(count((array) $user) < 1) {
            return response()->json([
                "error" => true,
                "data" => "Usuário não encontrado",
            ], 200);
        }

        if(!Hash::check($request->password, $user->password)) {
            return response()->json([
                "error" => true,
                "data" => "Senha incorreta",
            ], 401);
        }

        $token = JWT::encode(
            ['email' => $request->input('email')],
            env('JWT_KEY')
        );

        return response()->json([
            "error" => false,
            "data" => [
                "access_token" => $token
            ],
        ], 200);
    }
}
