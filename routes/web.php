<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::resource('version_morceau', App\Http\Controllers\Version_morceauController::class)->middleware('auth');

Route::resource('playlist', App\Http\Controllers\PlaylistController::class)->middleware('auth');

Route::resource('album', App\Http\Controllers\AlbumController::class)->middleware('auth');

Route::resource('genre', App\Http\Controllers\GenreController::class)->middleware('auth');

Route::resource('groupe', App\Http\Controllers\GroupeController::class)->middleware('auth');

Route::resource('artiste', App\Http\Controllers\ArtisteController::class)->middleware('auth');
//Route::put('artiste', App\Http\Controllers\ArtisteController::class, 'upadate')->name('artiste.updateImg');

Route::resource('genre_artiste', App\Http\Controllers\Genre_artisteController::class)->middleware('auth');
Route::resource('genre_groupe', App\Http\Controllers\Genre_groupeController::class)->middleware('auth');
Route::resource('membre', App\Http\Controllers\MembreController::class)->middleware('auth');



