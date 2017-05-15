<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

Route::group(['module' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['web', 'auth'], 'namespace' => 'Modules\Admin\Controllers'], function () {
	
	Route::get('/', ['as' => 'index', 'uses' => 'AdminController@index']);
	
	Route::resource('pages', 'PagesController', ['except' => ['show']]);
	
	Route::resource('letters', 'LettersController');
	
	Route::resource('users', 'UsersController');
	
	Route::get('settings', ['as' => 'settings.index', 'uses' => 'SettingsController@index']);
	
});