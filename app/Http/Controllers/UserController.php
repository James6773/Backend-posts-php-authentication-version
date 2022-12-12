<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast;

class UserController extends Controller
{
    public function list()
    {
        $user = User::all()->toArray();
        
        return response()->json(
            [
                'code' => 200,
                'status' => 'OK',
                'data' => $user
            ]
        );
        
    }

    public function store(Request $request)
    {
        $dataValidator = Validator::make($request->all(), [
            'role_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:30'],
            'password' => ['required', 'string', 'max:100'],
        ]);

        $emailValidator = Validator::make($request->all(), [
            'email' => ['unique:users'],
        ]); 

        if ($dataValidator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'status' => 'Bad Request',
                    'message' => '¡Complete todos los campos requeridos correctamente para crear un nuevo usuario!',
                ]
            );
        }

        if ($emailValidator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'status' => 'Bad Request',
                    'message' => '¡Ya existe otro usuario con el email '.$request->email.'!',
                ]
            );
        } 
        
        $role = Role::find($request->role_id);

        if (empty($role)) {
            return response()->json(
                [
                    'code' => 404,
                    'status' => 'Not Found',
                    'message' => '¡El id del rol ingresado no es válido!',
                ]
            );
        }

        $user = new User();

        $user->role_id = $request->role_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        return response()->json(
            [
                'code' => 201,
                'status' => 'Created',
                'message' => '¡Usuario guardado con éxito!',
                'data' => $user
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (empty($user)) {
            return response()->json(
                [
                    'code' => 400,
                    'status' => 'Not Found',
                    'message' => '¡El usuario que intenta actualizar no existe!',
                ]
            );
        }

        $dataValidator = Validator::make($request->all(), [
            'role_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:30'],
            'password' => ['required', 'string', 'max:100'],
        ]);

        $emailValidator = Validator::make($request->all(), [
            'email' => ['unique:users,email,'.$id],
        ]); 

        if ($dataValidator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'status' => 'Bad Request',
                    'message' => '¡Por favor no borre ninguno de los campos al actualizar un usuario!',
                ]
            );
        }

        if ($emailValidator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'status' => 'Bad Request',
                    'message' => '¡Ya existe otro usuario con el email '.$request->email.'!',
                ]
            );
        } 

        $role = Role::find($request->role_id);

        if (empty($role)) {
            return response()->json(
                [
                    'code' => 404,
                    'status' => 'Not Found',
                    'message' => '¡El id del rol ingresado no es válido!',
                ]
            );
        }
        
        $user->role_id = $request->role_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        return response()->json(
            [
                'code' => 201,
                'status' => 'Updated',
                'message' => '¡Usuario actualizado con éxito!',
                'data' => $user
            ]
        );
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            return response()->json(
                [
                    'code' => 404,
                    'status' => 'Not Found',
                    'message' => '¡El usuario que intenta eliminar no existe!',
                ]
            );
        }

        $user->delete();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'message' => '¡Usuario eliminado con éxito!'
        ]);
    }

    public function listById($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            return response()->json(
                [
                    'code' => 401,
                    'status' => 'Not Found',
                    'message' => '¡El usuario que intenta buscar no existe!',
                ]
            );
        }

        $user->toArray();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $user
        ]);
    }
}
