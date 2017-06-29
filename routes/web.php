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

//Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Activation user.
Route::get('activate/{id}/{token}', '\App\Http\Controllers\Auth\RegisterController@activation')->name('activation');

/* Image upload for TinyMCE */
Route::post('upload_into_temp', ['as' => 'uploadIntoTemp', 'before' => 'csrf-ajax', 'uses' => 'ImageUploadController@uploadIntoTemp']);
Route::post('delete_from_temp', ['as' => 'deleteFromTemp', 'before' => 'csrf-ajax', 'uses' => 'ImageUploadController@deleteFromTemp']);

/*
 * Ajax requests
 */
Route::post('send_letter', ['as' => 'contact.sendLetter', 'before' => 'csrf-ajax', 'uses' => 'PagesController@sendLetter']);
// Widgets
Route::post('request_call', ['as' => 'call.request', 'uses' => '\App\Widgets\RequestedCalls\RequestedCalls@create']);

/*
 * Pages
 */
Route::get('/', 'PagesController@index');



Route::get('sitemap.xml', ['as' => 'sitemapXml', 'uses' => 'PagesController@sitemapXml']);

Route::get('{parentOne}/{parentTwo}/{parentThree}/{page}', ['uses' => 'PagesController@pageFourLevel']);
Route::get('{parentOne}/{parentTwo}/{page}', ['uses' => 'PagesController@pageThreeLevel']);
Route::get('{parentOne}/{page}', ['uses' => 'PagesController@pageTwoLevel']);
Route::get('{page}', ['uses' => 'PagesController@pageOneLevel']);