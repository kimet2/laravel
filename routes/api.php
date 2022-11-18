<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register', [UserController::class, 'register']);


Route::post('login', [UserController::class, 'login']);


Route::group( ['middleware' => ["auth:sanctum"]], function(){
    //rutas
    Route::get('user-profile', [UserController::class, 'userProfile']);
    Route::get('logout', [UserController::class, 'logout']);

    //rutas para producto
    Route::post('registerProduct', [ProductController::class, 'createProduct']);
    Route::get('showProduct',[ProductController::class, 'showProduct']);
    Route::put('UpdateProduct', [ProductController::class, 'updateProduct']);
    Route::delete(' ',[ProductController::class, 'deleteProduct']);

    //rutas para categoria
    Route::post('registerCategory', [CategoryController::class, 'createCategory']);
    Route::get('showCategory',[CategoryController::class, 'showCategory']);
    Route::put('UpdateCategory', [CategoryController::class, 'updateCategory']);
    Route::delete('deleteCategory',[CategoryController::class, 'deleteCategory']);

});
