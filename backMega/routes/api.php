<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/save', [UserController::class, 'store']);
Route::get('/user/all', [UserController::class, 'index']);
Route::get('/user/find/{id}', [UserController::class, 'show']);
Route::post('/userfindBetweenDate', [UserController::class, 'filterBetweenDates']);
Route::get('/user/newest', [UserController::class, 'filterByNewestUsers']);
Route::put('/user/update/{id}', [UserController::class, 'update']);
Route::delete('/user/delete/{id}', [UserController::class, 'destroy']);


Route::post('/category/save', [CategoryController::class, 'store']);






Route::post('/product/save', [ProductController::class, 'store']);
Route::get('/product/all', [ProductController::class, 'index']);
