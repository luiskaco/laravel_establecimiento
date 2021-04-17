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

Route::get('/', 'InicioController')->name('inicio');

Auth::routes(['verify' => true]);

Route::middleware(['auth','verified'])->group(function () {

    Route::get('/establecimiento/create','EstablecimientoController@create')->name('establecimiento.create')->middleware('revisar');;
    Route::post('/establecimiento','EstablecimientoController@store')->name('establecimiento.store');
    Route::get('/establecimiento/{establecimiento}/edit','EstablecimientoController@edit')->name('establecimiento.edit');
    Route::put('/establecimiento/{establecimiento}','EstablecimientoController@update')->name('establecimiento.update');


    // Para imagen
    Route::post('/imagen/store', 'ImagenController@store')->name('imagenes.store');
    Route::post('/imagen/destroy', 'ImagenController@destroy')->name('imagenes.destroy');

});

Route::get('/establecimiento/show','EstablecimientoController@show')->name('establecimiento.show');
