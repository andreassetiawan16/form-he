<?php

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

Route::get('/data-kesehatan', 'DataKesehatanController@index')->name('data.kesehatan');
Route::get('/data-kesehatan/create', 'DataKesehatanController@create')->name('create.data.kesehatan');

Route::get('/data-peserta', 'PesertaController@index')->name('data.peserta');
Route::get('/data-peserta/create', 'PesertaController@create')->name('create.data.peserta');
Route::get('tablePeserta', 'PesertaController@table');
Route::post('/data-peserta/store', 'PesertaController@store');
Route::get('/data-peserta/{id}/show', 'PesertaController@show');