<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\NavigtionController;
use App\Http\Controllers\admin\NavigtionItemController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductImageController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\front\CheckoutController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return response()->json(['user'=> $request->user()]) ;
})->middleware('auth:sanctum');

// Auth Routes
Route::post('/login', [UserAuthController::class,'login']);
Route::post('/register', [UserAuthController::class,'register']);
Route::get('products', [ProductController::class,'allProduct']);
Route::get('product-detail/{SKU}', [ProductController::class,'productDetail']);
Route::get('quick-view/{SKU}', [ProductController::class,'quickView']);
Route::get('/home', [HomeController::class,'index']);
// Admin Routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [UserAuthController::class,'logout']);
    Route::post('/checkout', [CheckoutController::class,'submitOrder']);

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


