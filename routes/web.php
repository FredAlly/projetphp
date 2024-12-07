<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\EnregistrementController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/apropos', function () {
    return view('apropos');
}); 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route:: get ('/', [FilmController::class, 'index']);
Route::post('/autocomplete', [FilmController::class,'autocomplete'])->name('autocomplete');
Route::get('lang/{locale}', [App\Http\Controllers\LocalizationController::class, 'index'])->name('change.lang');

Route::get('/films/{id}/utilisateurs', [FilmController::class, 'showUtilisateurs'])->name('film.utilisateurs');

Route::resources([
                 'films'=> FIlmController::class,
                 'enregistrements'=> EnregistrementController::class,
                ]);




Auth::routes();



Route:: get ('/admin/films', [FIlmController::class, 'index'])->middleware('admin')->name('films.index'); 
Route:: get ('/admin/films/create', [FIlmController::class, 'create'])->middleware('admin')->name('films.create');
Route:: post ('/admin/films/store', [FIlmController::class, 'store'])->middleware('admin')->name('films.store'); 
Route:: get ('/admin/films/{id}', [FIlmController::class, 'show'])->middleware('admin')->name('films.show'); 
Route:: get ('/admin/films/{id}/edit', [FIlmController::class, 'edit'])->middleware('admin')->name('films.edit'); 
Route:: patch ('/admin/films/{id}/update', [FIlmController::class, 'update'])->middleware('admin')->name('films.update'); 
Route:: delete ('/admin/films/{id}', [FIlmController::class, 'destroy'])->middleware('admin')->name('films.destroy'); 