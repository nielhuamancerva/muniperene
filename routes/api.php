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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/athenticated', function () {
    return true;
});
Route::post('register', 'App\Http\Controllers\Login\RegisterController@register');
Route::post('login', 'App\Http\Controllers\Login\LoginController@login');
Route::post('logout', 'App\Http\Controllers\Login\LoginController@logout');
Route::get('/backindex', 'App\Http\Controllers\Welcome\SlideController@index')->name('backindex');

Route::resource('noticias', 'App\Http\Controllers\Welcome\NoticiasController');
Route::resource('normatividad', 'App\Http\Controllers\Normatividad\NormatividadController');
Route::resource('tipodocumentos', 'App\Http\Controllers\TipoDocumentos\TipoDocumentosController');