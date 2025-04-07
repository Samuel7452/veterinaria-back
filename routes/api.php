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
// Route::post('register', function () {
//     return view('register')->with('user_type_id', 1);
// });

Route::post('register', function (Request $request) {
    return App::call([\App\Http\Controllers\AuthController::class, 'register'], [
        'request' => $request,
        'user_type_id' => 1,
    ]);
});


Route::middleware('auth:sanctum')->group(function () {
    
    // Route::post('register/veterinarian/', [\App\Http\Controllers\AuthController::class, 'register({2})']);

    // Route::post('register/veterinarian/', function () {
    //     return view('register')->with('user_type_id', 2);
    // });

    Route::post('register/veterinarian/', function (Request $request) {
        return App::call([\App\Http\Controllers\AuthController::class, 'register'], [
            'request' => $request,
            'user_type_id' => 2,
        ]);
    });

    //  User related routes
    Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);
    Route::get('user/index', [\App\Http\Controllers\UserController::class, 'index']);
    Route::patch('user/update/{user}', [\App\Http\Controllers\UserController::class, 'update']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::get('user/get/{reqUser}', [\App\Http\Controllers\UserController::class, 'get']);
    
    // pets related routes
    Route::get('pet', [\App\Http\Controllers\PetController::class, 'pet']);
    Route::get('pet/get/{pet}', [\App\Http\Controllers\PetController::class, 'get']);
    Route::get('pet/getByUser/{user}', [\App\Http\Controllers\PetController::class, 'getByUser']);
    Route::post('pet/create', [\App\Http\Controllers\PetController::class, 'create']);
    Route::post('pet/update/{pet}', [\App\Http\Controllers\PetController::class, 'update']);
    Route::delete('pet/delete/{pet}', [\App\Http\Controllers\PetController::class, 'delete']);
    
    // Medical histories related routes
    Route::post('medicalHistory/create', [\App\Http\Controllers\MedicalHistoryController::class, 'create']);
    Route::get('medicalHistory/get/{history}', [\App\Http\Controllers\MedicalHistoryController::class, 'get']);
    Route::get('medicalHistory/getByPet/{pet}', [\App\Http\Controllers\MedicalHistoryController::class, 'getByPet']);
    Route::delete('medicalHistory/delete/{medicalHistory}', [\App\Http\Controllers\MedicalHistoryController::class, 'delete']);
    Route::patch('medicalHistory/update/{medicalHistory}', [\App\Http\Controllers\MedicalHistoryController::class, 'update']);
    
    //  Citations related routes
    Route::post('citation/create', [\App\Http\Controllers\CitationController::class, 'create']);
    Route::get('citation/getByUser/{user}', [\App\Http\Controllers\CitationController::class, 'getByUser']);

});
 
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
});
