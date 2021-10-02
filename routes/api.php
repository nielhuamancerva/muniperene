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
Route::post('logout', 'App\Http\Controllers\Login\LoginController@logout')->middleware('auth:sanctum');

Route::get('/backindex', 'App\Http\Controllers\Welcome\SlideController@index')->name('backindex');


Route::get('/cas', 'App\Http\Controllers\ConvocatoriaCas\ConvocatoriaController@index')->name('cas');
Route::get('/gestorcas', 'App\Http\Controllers\ConvocatoriaCas\GestorConvocatoriaController@index')->name('gestorcas');

Route::get('/downloads/{file}', 'App\Http\Controllers\ConvocatoriaCas\ConvocatoriaController@download');

Route::get('/download/{file}', 'App\Http\Controllers\Normatividad\PublicacionNormatividadController@download');


Route::resource('normas', 'App\Http\Controllers\Normatividad\PublicacionNormatividadController');

Route::resource('noticias', 'App\Http\Controllers\Welcome\NoticiasController');
Route::resource('normatividad', 'App\Http\Controllers\Normatividad\NormatividadController')->middleware('auth:sanctum');
Route::post('botones', 'App\Http\Controllers\Login\LoginController@botones')->middleware('auth:sanctum');

Route::resource('gat', 'App\Http\Controllers\GAT\GatController')->middleware('auth:sanctum');

Route::resource('tipodocumentos', 'App\Http\Controllers\TipoDocumentos\TipoDocumentosController');