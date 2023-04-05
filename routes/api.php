<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth/login',[App\Http\Controllers\Api\AuthenticateController::class,'authenticate']);
Route::post('auth/register',[App\Http\Controllers\Api\AuthenticateController::class,'register']);
Route::post('auth/logout',[App\Http\Controllers\Api\AuthenticateController::class,'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::apiResource('categories',App\Http\Controllers\Api\CategoryController::class);
    Route::apiResource('transactions',App\Http\Controllers\Api\TransactionController::class);
});
