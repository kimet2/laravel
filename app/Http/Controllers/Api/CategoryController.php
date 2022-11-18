<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function createCategory(Request $request)
    {
        $request->validate([
            "name" => "required",
            "description" => "required"
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return response([
            "status" => 1,
            "msg" => "Categoria insertada correctamente!",
        ]);
    }

    public function showCategory(Request $request)
    {
        $request->validate([
            'id' => 'nullable',
            'name' => 'nullable',
        ]);

        if(empty($request -> id || $request -> name)){
            $category = Category::select('id', 'name', 'description')
                        ->get();
        }else{
            $category = Category::select('id', 'name', 'description')
                        ->where('id', '=', $request->id)
                        ->orWhere('name', $request->name)
                        ->get();
        }
        return response()->json([
            "status" => 1,
            "msg" => "lista de categorias",
            "data" => $category,
        ]);
    }

    public function updateCategory(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'Name2' => 'nullable',
            'Description2' => 'nullable',
        ]);

        if(isset($request -> Name2)){

            DB::table('categories')
            ->where('id', '=', $request->id)
            ->update(array('name' => $request->Name2));

        }
        
        if(isset($request -> Description2)){

            DB::table('categories')
            ->where('id', '=', $request->id)
            ->update(array('description' => $request->Description2));

        }

        return response()->json([
            "status" => 1,
            "msg" => "Se ha actualizado la categoria",
        ]);
    }
    public function deleteCategory(Request $request)
    {
        $request->validate([
            'id' => 'nullable',
            'name' => 'nullable',
        ]);

        DB::table('categories')
            ->where('id', '=', $request->id)
            ->orWhere('name', '=', $request->name)
            ->delete();

        return response()->json([
            "status" => 1,
            "msg" => "Se ha eliminado  la categoria",
        ]);
    }
}
