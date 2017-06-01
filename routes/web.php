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

/* Image upload for TinyMCE */
Route::post('upload_into_temp', ['as' => 'uploadIntoTemp', 'before' => 'csrf-ajax', 'uses' => 'ImageUploadController@uploadIntoTemp']);
Route::post('delete_from_temp', ['as' => 'deleteFromTemp', 'before' => 'csrf-ajax', 'uses' => 'ImageUploadController@deleteFromTemp']);

/*
 * Pages
 */
Route::get('/', 'PagesController@index');

Route::get('sitemap.xml', ['as' => 'sitemapXml', 'uses' => 'PagesController@sitemapXml']);

Route::get('{parentOne}/{parentTwo}/{parentThree}/{page}', ['uses' => 'PagesController@pageFourLevel']);
Route::get('{parentOne}/{parentTwo}/{page}', ['uses' => 'PagesController@pageThreeLevel']);
Route::get('{parentOne}/{page}', ['uses' => 'PagesController@pageTwoLevel']);
Route::get('{page}', ['uses' => 'PagesController@pageOneLevel']);