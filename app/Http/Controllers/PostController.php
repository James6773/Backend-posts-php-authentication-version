<?php
/* */
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast;

class PostController extends Controller
{
    public function list(Request $request)
    {   
        $token = substr($request->header('Authorization', 'Token <token>'), 6);
        
        $post = Post::all()->toArray();
        
        return response()->json(
            [
                'code' => 200,
                'status' => 'OK',
                'token' => $token,
                'data' => $post,
            ]
        );
        
    }

    public function store(Request $request)
    {
        $token = substr($request->header('Authorization', 'Token <token>'), 6);

        $dataValidator = Validator::make($request->all(), [
            'user_id' => ['required', 'integer'],
            'category_id' => ['required', 'integer'],
            'tittle' => ['required', 'string', 'max:20'],
            'description' => ['nullable', 'string', 'max:255'],
            'state' => ['required', 'integer'],
            'content' => ['required', 'string', 'max:30'],
        ]);

        $tittleValidator = Validator::make($request->all(), [
            'tittle' => ['unique:posts'],
        ]); 

        $stateValidator = Validator::make($request->all(), [
            'state' => ['in:0,1'],
        ]); 

        if ($dataValidator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'status' => 'Bad Request',
                    'message' => '¡Complete todos los campos requeridos correctamente para crear un nuevo post!',
                ]
            );
        }

        if ($tittleValidator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'status' => 'Bad Request',
                    'message' => '¡Ya existe otro post con el título '.$request->tittle.'!',
                ]
            );
        } 
        
        if ($stateValidator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'status' => 'Bad Request',
                    'message' => '¡El estado ingresado no es valido! No Publicado:0 / Publicado:1',
                ]
            );
        } 

        $user = User::find($request->user_id);

        if (empty($user)) {
            return response()->json(
                [
                    'code' => 404,
                    'status' => 'Not Found',
                    'message' => '¡El id del usuario ingresado no existe!',
                ]
            );
        }

        $category = Category::find($request->category_id);

        if (empty($category)) {
            return response()->json(
                [
                    'code' => 404,
                    'status' => 'Not Found',
                    'message' => '¡El id de la categoría ingresada no existe!',
                ]
            );
        }

        $post = new Post();

        $post->user_id = $request->user_id;
        $post->category_id = $request->category_id; 
        $post->tittle = $request->tittle;
        $post->description = $request->description;
        $post->state = $request->state;
        $post->content = $request->content;

        $post->save();

        return response()->json(
            [
                'code' => 201,
                'status' => 'Created',
                'message' => '¡Post creado con éxito!',
                'data' => $post
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $token = substr($request->header('Authorization', 'Token <token>'), 6);

        $post = Post::find($id);

        if (empty($post)) {
            return response()->json(
                [
                    'code' => 404,
                    'status' => 'Not Found',
                    'message' => '¡El post que intenta actualizar no existe!',
                ]
            );
        }

        $dataValidator = Validator::make($request->all(), [
            'user_id' => ['required', 'integer'],
            'category_id' => ['required', 'integer'],
            'tittle' => ['required', 'string', 'max:20'],
            'description' => ['nullable', 'string', 'max:255'],
            'state' => ['required', 'integer'],
            'content' => ['required', 'string', 'max:30'],
        ]);

        $tittleValidator = Validator::make($request->all(), [
            'tittle' => ['unique:posts,tittle,'.$id],
        ]); 

        $stateValidator = Validator::make($request->all(), [
            'state' => ['in:0,1'],
        ]); 

        if ($dataValidator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'status' => 'Bad Request',
                    'message' => '¡Por favor no borre ninguno de los campos al actualizar un post!',
                ]
            );
        }

        if ($tittleValidator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'status' => 'Bad Request',
                    'message' => '¡Ya existe otro post con el título '.$request->tittle.'!',
                ]
            );
        } 
        
        if ($stateValidator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'status' => 'Bad Request',
                    'message' => '¡El estado ingresado no es valido! No Publicado:0 / Publicado:1',
                ]
            );
        } 

        $user = User::find($request->user_id);

        if (empty($user)) {
            return response()->json(
                [
                    'code' => 404,
                    'status' => 'Not Found',
                    'message' => '¡El id del usuario ingresado no existe!',
                ]
            );
        }

        $category = Category::find($request->category_id);

        if (empty($category)) {
            return response()->json(
                [
                    'code' => 404,
                    'status' => 'Not Found',
                    'message' => '¡El id de la categoría ingresada no existe!',
                ]
            );
        }
        
        $post = Post::find($id);
        
        $post->user_id = $request->user_id;
        $post->category_id = $request->category_id; 
        $post->tittle = $request->tittle;
        $post->description = $request->description;
        $post->state = $request->state;
        $post->content = $request->content;

        $post->save();

        return response()->json(
            [
                'code' => 201,
                'status' => 'Created',
                'message' => '¡Post actualizado con éxito!',
                'data' => $post
            ]
        );
    }

    public function destroy($id)
    {
        $token = substr($request->header('Authorization', 'Token <token>'), 6);

        $post = Post::find($id);

        if (empty($post)) {
            return response()->json(
                [
                    'code' => 404,
                    'status' => 'Not Found',
                    'message' => '¡El post que intenta eliminar no existe!',
                ]
            );
        }

        $post->delete();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'message' => '¡Post eliminado con éxito!'
        ]);
    }

    public function listById($id)
    {
        $token = substr($request->header('Authorization', 'Token <token>'), 6);
        
        $post = Post::find($id);

        if (empty($post)) {
            return response()->json(
                [
                    'code' => 401,
                    'status' => 'Not Found',
                    'message' => '¡El post que intenta buscar no existe!',
                ]
            );
        }

        $post->toArray();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $post
        ]);
    }
}
