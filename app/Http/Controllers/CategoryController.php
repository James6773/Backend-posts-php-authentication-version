<?php


namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast;

class CategoryController extends Controller
{
    /*public function apiWelcome()
    {
        return response()->json([
            'message' => '¡Bienvenido usuario!'
        ]);
    }

    try {

        } catch (\Exception $e) {
            return $e->json(
                [
                    'code' => 500,
                    'status' => 'Internal Server Error',
                    'message' => '¡Ocurrió un error en el servidor!'
                ]
            );    
        }*/

    public function list()
    {        
        $category = Category::all()->toArray();
        
        return response()->json(
            [
                'code' => 200,
                'status' => 'OK',
                'data' => $category
            ]
        );
        
    }

    public function store(Request $request)
    {
        $dataValidator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:20'],
            'description' => ['nullable', 'string', 'max:255'],
           
        ]);

        $nameValidator = Validator::make($request->all(), [
            'name' => ['unique:categories'],
        ]); 

        if ($dataValidator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'status' => 'Bad Request',
                    'message' => '¡Complete todos los campos requeridos correctamente para crear una nueva categoría!',
                ]
            );
        }

        if ($nameValidator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'status' => 'Bad Request',
                    'message' => '¡Ya existe otra categoría con el nombre '.$request->name.'!',
                ]
            );
        } 
        
        $category = new Category();

        $category->name = $request->name;
        $category->description = $request->description;

        $category->save();

        return response()->json(
            [
                'code' => 201,
                'status' => 'Created',
                'message' => '¡Categoría creada con éxito!',
                'data' => $category
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (empty($category)) {
            return response()->json(
                [
                    'code' => 404,
                    'status' => 'Not Found',
                    'message' => '¡La categoría que intenta actualizar no existe!',
                ]
            );
        }

        $dataValidator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:20'],
            'description' => ['nullable', 'string', 'max:255'],
           
        ]);

        $nameValidator = Validator::make($request->all(), [
            'name' => ['unique:categories,name,'.$id],
        ]); 

        if ($dataValidator->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'status' => 'Bad Request',
                    'message' => '¡Por favor no borre ninguno de los campos al actualizar una categoría!',
                ]
            );
        }

        if ($nameValidator ->fails()) {
            return response()->json(
                [
                    'code' => 400,
                    'status' => 'Bad Request',
                    'message' => '¡Ya existe otra categoría con el nombre '.$request->name.'!',
                ]
            );
        }

        $category->name = $request->name;
        $category->description = $request->description;
        
        $category->save();

        return response()->json(
            [
                'code' => 201,
                'status' => 'Updated',
                'message' => '¡Categoría actualizada con éxito!',
                'data' => $category
            ]
        );       
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (empty($category)) {
            return response()->json(
                [
                    'code' => 401,
                    'status' => 'Not Found',
                    'message' => '¡La categoría que intenta eliminar no existe!',
                ]
            );
        }

        $category->delete();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'message' => '¡Categoría eliminada con éxito!'
        ]);
    }

    public function listById($id)
    {
        $category = Category::find($id);

        if (empty($category)) {
            return response()->json(
                [
                    'code' => 401,
                    'status' => 'Not Found',
                    'message' => '¡La categoría que intenta buscar no existe!',
                ]
            );
        }

        $category->toArray();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $category
        ]);
    }
}
