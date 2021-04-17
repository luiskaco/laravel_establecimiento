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


/** Listado de API **/
Route::get('/establecimientos', 'ApiController@index')->name('establecimiento.index');

Route::get('/establecimientos/{establecimiento}','ApiController@show')->name('establecimientos.show');

Route::get('/categorias/{categoria}', 'ApiController@cantegoria')->name('categoria');
Route::get('/todoscategorias/{categoria}', 'ApiController@establecimientocategoria')->name('todos.categoria');

Route::get('/categorias', 'ApiController@cantegorias')->name('categorias');


/**
 * Nota: todos las rutas las consultamos por api/
 */
