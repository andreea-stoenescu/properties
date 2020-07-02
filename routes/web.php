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

Route::get('/properties', '\App\Http\Controllers\PropertyController@search')->name('search_properties');
Route::get('/properties/new', '\App\Http\Controllers\PropertyController@new')->name('new_property');
Route::post('/properties/new', '\App\Http\Controllers\PropertyController@create');
Route::get('/properties/{uuid}', '\App\Http\Controllers\PropertyController@edit')->name('edit_property');
Route::post('/properties/{uuid}', '\App\Http\Controllers\PropertyController@update');
