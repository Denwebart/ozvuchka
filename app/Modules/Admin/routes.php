<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

Route::group(['module' => 'Admin', 'prefix' => 'admin', 'middleware' => ['web'], 'namespace' => 'Modules\Admin\Controllers'], function () {
	
	Route::get('/', ['as' => 'admin.index', 'uses' => 'AdminController@index']);
	
	Route::get('/letters', ['as' => 'admin.letters.index', 'uses' => 'AdminController@index']);
	Route::get('/letters/{id}', ['as' => 'admin.letters.show', 'uses' => 'AdminController@index']);
	
});