<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::group(['prefix'=>'category-product','middleware'=>'auth:api'], function(){
	Route::get('get',[CategoryProductController::class,'index']);
	Route::get('show/{id}',[CategoryProductController::class,'show']);
	Route::post('add',[CategoryProductController::class,'store']);
	Route::post('update/{id}',[CategoryProductController::class,'update']);
	Route::delete('delete/{id}',[CategoryProductController::class,'destroy']);
});

Route::group(['prefix'=>'cart','middleware'=>'auth:api'], function(){
	Route::post('add',[CartController::class,'store']);
	Route::get('show/{id}',[CartController::class,'show']);
});

Route::group(['prefix'=>'checkout','middleware'=>'auth:api'], function(){
	Route::get('checkout/{id}',[CheckoutController::class,'checkout']);
	Route::get('change-status/{id}/{status}',[CheckoutController::class,'changeStatus']);
});


