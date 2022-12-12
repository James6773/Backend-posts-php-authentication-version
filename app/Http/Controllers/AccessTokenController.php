<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast;
use Firebase\JWT\JWT;

class AccessTokenController extends Controller
{
    public function getJWT(Request $request, $user_id)
    {
        $user = User::find($user_id);

        if (empty($user)) {
            return response()->json(
                [
                    'code' => 400,
                    'status' => 'Not Found',
                    'message' => '¡El id de usuario no existe!',
                ]
            );
        }

        $jwt = JWT::encode(['user_data' => $user], env('JWT_SECRET'), 'HS256');

        //$user->access_token = $jwt;
        //$user->save();

        return response()->json(
            [
                'code' => 200,
                'status' => 'OK',
                'message' => '¡Tu token de acceso fue creado exitosamente!',
                'token' => $jwt
            ]
        );
    }
}
    