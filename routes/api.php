<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\OrderProductsController;
use App\Http\Controllers\FiltersController;

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

// Route::get('/products', function(){
//     return 'Testing';
// });


// Products CRUD
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
Route::get('/products/{id}', [ProductController::class, 'show']);

// Orders CRUD
Route::get('/orders', [OrdersController::class, 'index']);
Route::post('/orders', [OrdersController::class, 'store']);
Route::put('/orders/{id}', [OrdersController::class, 'update']);
Route::delete('/orders/{id}', [OrdersController::class, 'destroy']);
Route::get('/orders/{id}', [OrdersController::class, 'show']);

// OrderProducts CRUD
Route::get('/order-products', [OrderProductsController::class, 'index']);
Route::post('/order-products', [OrderProductsController::class, 'store']);
Route::put('/order-products/{id}', [OrderProductsController::class, 'update']);
Route::delete('/order-products/{id}', [OrderProductsController::class, 'destroy']);
Route::get('/order-products/{id}', [OrderProductsController::class, 'show']);

// Filters
Route::get('/co2tot', [FiltersController::class, 'co2tot']);
Route::get('/forcountry', [FiltersController::class, 'forcountry']);
Route::get('/forproduct', [FiltersController::class, 'forproduct']);
Route::post('/fortemp', [FiltersController::class, 'fortemp']);
