<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast;
use Firebase\JWT\JWT;

class AuthController extends Controller
{
    public function authentication(Request $request)
    {
        $dataValidator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'email', 'max:255'],
           
        ]);

        if ($dataValidator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'status' => 'Bad Request',
                    'message' => '¡Complete todos los campos requeridos correctamente para iniciar sesión!',
                ]
            );
        }
        
        $userEmail = User::find($request->email);

        if (empty($userEmail)) {
            return response()->json(
                [
                    'code' => 400,
                    'status' => 'Not Found',
                    'message' => '¡El email no existe!',
                ]
            );
        }

        $userPassword = User::find($request->password);

        if (empty($userPassword)) {
            return response()->json(
                [
                    'code' => 400,
                    'status' => 'Not Found',
                    'message' => '¡La contraseña no existe!',
                ]
            );
        }

        $user = User::find($id);

        $jwt = JWT::encode(['user_data' => $user], env('JWT_SECRET'), 'HS256');

        return response()->json(
            [
                'code' => 200,
                'status' => 'OK',
                'message' => '¡Tu token de acceso fue creado exitosamente!',
                'token' => $jwt,
                'data' => $request->all()
            ]
        );
    }

}