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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', 'App\Http\Controllers\Login\LoginController@login');
Route::post('logout', 'App\Http\Controllers\Login\LoginController@logout');
Route::get('/cas', 'App\Http\Controllers\ConvocatoriaCas\ConvocatoriaController@index')->name('cas');
Route::get('/backindex', 'App\Http\Controllers\Welcome\SlideController@index')->name('backindex');
Route::resource('tipodocumentos', 'App\Http\Controllers\TipoDocumentos\TipoDocumentosController');
Route::resource('normas', 'App\Http\Controllers\Normatividad\PublicacionNormatividadController');

Route::group(["middleware" => "auth:api"], function () {
    Route::resource('users', 'App\Http\Controllers\Users\UserController');
    Route::resource('normatividad', 'App\Http\Controllers\Normatividad\NormatividadController');
    Route::post('register', 'App\Http\Controllers\Login\RegisterController@register');
    Route::resource('noticias', 'App\Http\Controllers\Welcome\NoticiasController');
    Route::get('/gestorcas', 'App\Http\Controllers\ConvocatoriaCas\GestorConvocatoriaController@index')->name('gestorcas');
    Route::post('/gestorcas', 'App\Http\Controllers\ConvocatoriaCas\GestorConvocatoriaController@store')->name('gestorcas');
    Route::resource('gat', 'App\Http\Controllers\GAT\GatController');
    Route::get('/gestormesadepartesvirtual', 'App\Http\Controllers\MesadePartesVirtual\GestorMesadePartesVirtualController@index');
});

Route::get('/mesadepartesvirtual', 'App\Http\Controllers\MesadePartesVirtual\MesadePartesVirtualController@index');

Route::get('/downloads/{file}', 'App\Http\Controllers\ConvocatoriaCas\ConvocatoriaController@download');
Route::get('/download/{file}', 'App\Http\Controllers\Normatividad\PublicacionNormatividadController@download');
Route::post('botones', 'App\Http\Controllers\Login\LoginController@botones')->middleware('auth:sanctum');





