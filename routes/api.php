<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|*/
// +++ Initial route for test +++ //
// Route::get('/products', function(){
//     return Product::all();
// });

// Test route with model create and db connection
// Route::post('/addProducts', function() {
//     return Product::create([
//         'name'          =>  'Product one',
//         'slug'          =>  'product-one',
//         'description'   =>  'This is product one',
//         'price'         =>  '99.99'
//     ]);
// });

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/products',     [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/search/{name}', [ProductController::class, 'search']);

// Route search products //
// Route::get('/products/search/{name}',[ProductController::class, 'search']);

// Protected routes with 'sanctum auth' //
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
