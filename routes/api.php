<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\NavigtionController;
use App\Http\Controllers\admin\NavigtionItemController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductImageController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\front\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return response()->json(['user'=> $request->user()]) ;
})->middleware('auth:sanctum');

// Auth Routes
Route::post('/login', [UserAuthController::class,'login']);
Route::post('/register', [UserAuthController::class,'register']);

// Admin Routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [UserAuthController::class,'logout']);
    Route::group([ 'prefix' => '/product'], function () {
        Route::apiResource('products', ProductController::class);
        Route::apiResource('images', ProductImageController::class);
    });
    Route::group([ 'prefix' => '/navigation'], function () {
        Route::apiResource('navigations', NavigtionController::class);
        Route::apiResource('navigation-items', NavigtionItemController::class);
    });
    Route::group([ 'prefix' => '/category'], function () {
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('sub-categories', SubCategoryController::class);
    });
    Route::group(['prefix' => '/cart'], function () {
        Route::apiResource('carts', CartController::class);
    });
});


