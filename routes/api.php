<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Files\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\UserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Messages;



Route::post('/images',function(Request $request){
return gettype($request->file('image'));
});
Route::controller(AuthController::class)->group(function(){
    Route::post('register','register');
    Route::post('/login', 'login');
    Route::post('/auth/google','google_auth');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

Route::apiResource('products/images', ProductImageController::class);
Route::apiResource('category', CategoryController::class)->missing(function(){

    return response()->json(['data'=>null,'message'=>'category not found'],404);
});
Route::apiResource('users', UserController::class)->missing(function(){

    return response()->json(['data'=>null,'message'=>'user not found'],404);
});;
Route::apiResource('products', ProductController::class)->missing(function(){
    return response()->json(['data'=>null,'message'=>'product not found'],404);
});

