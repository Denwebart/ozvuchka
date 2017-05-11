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

Auth::routes();
// Activation user.
Route::get('activate/{id}/{token}', '\App\Http\Controllers\Auth\RegisterController@activation')->name('activation');

Route::get('/', 'PagesController@index');
