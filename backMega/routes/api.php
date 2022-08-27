<?php

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

Route::post('/save', [UserController::class, 'store']);
Route::get('/all', [UserController::class, 'index']);
Route::get('/find/{id}', [UserController::class, 'show']);
Route::post('/findByDate', [UserController::class, 'filterBetweenDates']);
Route::get('/newest', [UserController::class, 'filterByNewestUsers']);
Route::put('/update/{id}', [UserController::class, 'update']);
