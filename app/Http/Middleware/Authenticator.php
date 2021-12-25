<?php

namespace App\Http\Middleware;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class Authenticator
{
    public function handle(Request $request, \Closure $next)
    {
        try {

            $token = str_replace('Bearer ', '', $request->header('Authorization'));
            $dataToken = JWT::decode($token, env('JWT_KEY'), ['HS256']);
            $user = User::query()
                ->where("email", $dataToken->email)
                ->first();

            if(count((array) $user) < 1) {
                throw new \Exception();
            }

            return $next($request);

        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "data" => "Não autorizado",
            ], 401);
        }
    }
}
