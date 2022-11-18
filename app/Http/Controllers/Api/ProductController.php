<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    
    public function createProduct(Request $request)
    {
        $request->validate([
            "category_id" => "required",
            "name" => "required",
            "descripcion" => "required",
            "price" => "required",
        ]); 
        
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->descripcion = $request->descripcion;
        $product->price = $request->price;
        $product->save();
        return response([
            "status" => 1,
            "msg" => "Producto insertado correctamente!",
        ]);
    }


    public function showProduct(Request $request)
    {
        $request->validate([
            'category_id' => 'nullable',
            'name' => 'nullable',
            'descripcion' => 'nullable',
            'price' => 'nullable'
        ]);

        if(empty($request -> category_id || $request -> name || $request -> descripcion || $request -> price)){
            $product = Product::select('category_id', 'name', 'descripcion', 'price')
                        ->get();
        }else{
            $product = Product::select('category_id', 'name', 'descripcion', 'price')
                        ->where('category_id', '=', $request->category_id)
                        ->orWhere('name', $request->name)
                        ->orWhere('descripcion', $request->descripcion)
                        ->orWhere('price', $request->price)
                        ->get();
        }
        return response()->json([
            "status" => 1,
            "msg" => "lista de productos",
            "data" => $product,
        ]);
    }
    
    public function updateProduct(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'Name2' => 'nullable',
            'Descripcion2' => 'nullable',
            'price2' => 'nullable'
        ]);

        if(isset($request -> Name2)){

            DB::table('products')
            ->where('category_id', '=', $request->category_id)
            ->update(array('name' => $request->Name2));

        }
        
        if(isset($request -> Descripcion2)){

            DB::table('products')
            ->where('category_id', '=', $request->category_id)
            ->update(array('descripcion' => $request->Descriction2));

        }
        if(isset($request -> price2)){

            DB::table('products')
            ->where('category_id', '=', $request->category_id)
            ->update(array('price' => $request->price2));

        }

        return response()->json([
            "status" => 1,
            "msg" => "Se ha actualizado el producto",
        ]);
    }
    public function deleteProduct(Request $request)
    {
       
        $request->validate([
            'category_id' => 'nullable',
            'name' => 'nullable',
            'descripcion' => 'nullable',
            'price' => 'nullable',
        ]);

        DB::table('products')
            ->where('category_id', '=', $request->category_id)
            ->orWhere('name', '=', $request->name)
            ->orWhere('descripcion', '=', $request->descripcion)
            ->orWhere('price', '=', $request->price)
            ->delete();

        return response()->json([
            "status" => 1,
            "msg" => "Se ha eliminado  el producto",
        ]);
    }
}