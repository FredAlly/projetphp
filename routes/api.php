<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FilmController;
use App\Http\Controllers\Api\RegisterController;

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





Route::post('register', [RegisterController::class, 'register']);

Route::post('login', [RegisterController::class, 'login']);
Route::get('/films', [FilmController::class, 'index']);
Route::get('/films/{id}', [FilmController::class, 'show']);
     
//Route::resource('films', FilmController::class);
Route::middleware('auth:sanctum')->group( function () {
    //Route::resource('films', FilmController::class);
    // Route::get('films', [FilmController::class, 'index']);
    Route::post('films/', [FilmController::class, 'store']);
    Route::get('films/edit/{id}', [FilmController::class, 'edit']);
    Route::put('films/update/{id}', [FilmController::class, 'update']);
    Route::delete('films/{id}', [FilmController::class, 'destroy']); 

});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
