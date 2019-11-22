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
Route::get('/tableDataKesehatan', 'DataKesehatanController@table');
Route::post('/data-kesehatan/store', 'DataKesehatanController@store');
Route::get('/data-kesehatan/{id}/detail', 'DataKesehatanController@show');
Route::get('/data-kesehatan/{id}/edit', 'DataKesehatanController@edit');
Route::post('/data-kesehatan/{id}/update', 'DataKesehatanController@update');
Route::post('/data-kesehatan/delete', 'DataKesehatanController@destroy');

Route::get('/event','EventController@index')->name('events');
Route::get('/event/create', 'EventController@create')->name('create.event');
Route::get('tableEvents', 'EventController@table');
Route::post('/event/store', 'EventController@store');
Route::get('/event/{id}/detail', 'EventController@show');
Route::get('/event/{id}/edit', 'EventController@edit');
Route::post('/event/{id}/update', 'EventController@update');
Route::post('/event/delete', 'EventController@destroy');

Route::get('/data-peserta', 'PesertaController@index')->name('data.peserta');
Route::get('/data-peserta/create', 'PesertaController@create')->name('create.data.peserta');
Route::get('tablePeserta', 'PesertaController@table');
Route::post('/data-peserta/store', 'PesertaController@store');
Route::get('/data-peserta/{id}/detail', 'PesertaController@show');
Route::get('/data-peserta/{id}/edit', 'PesertaController@edit');
Route::post('/data-peserta/{id}/update', 'PesertaController@update');
Route::post('/data-peserta/delete', 'PesertaController@destroy');
Route::get('/data-peserta/search', 'PesertaController@search');