<?php

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


Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);
    Route::get('user/index', [\App\Http\Controllers\UserController::class, 'index']);
    Route::patch('user/edit/{user}', [\App\Http\Controllers\UserController::class, 'update']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    
    Route::get('pet', [\App\Http\Controllers\PetController::class, 'pet']);
    Route::get('pet/get/{pet}', [\App\Http\Controllers\PetController::class, 'get']);
    Route::post('pet/create', [\App\Http\Controllers\PetController::class, 'create']);
    Route::post('pet/update/{pet}', [\App\Http\Controllers\PetController::class, 'update']);
    Route::delete('pet/delete/{pet}', [\App\Http\Controllers\PetController::class, 'delete']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
});
