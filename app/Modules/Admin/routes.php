<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

Route::group(['module' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['web', 'auth'], 'namespace' => 'Modules\Admin\Controllers'], function () {
	
	Route::get('/', ['as' => 'index', 'uses' => 'AdminController@index']);
	
	Route::post('pages/change_published_status/{id}', ['as' => 'pages.changePublishedStatus', 'uses' => 'PagesController@changePublishedStatus']);
	Route::resource('pages', 'PagesController', ['except' => ['show']]);
	
	Route::resource('calls', 'RequestedCallsController', ['except' => ['create', 'store', 'show']]);
	
	Route::post('letters/change_important_status/{id}', ['as' => 'letters.changeImportantStatus', 'uses' => 'LettersController@changeImportantStatus']);
	Route::post('letters/undelete/{id}', ['as' => 'letters.undelete', 'uses' => 'LettersController@undelete']);
	Route::get('letters/important', ['as' => 'letters.important', 'uses' => 'LettersController@important']);
	Route::get('letters/trash', ['as' => 'letters.trash', 'uses' => 'LettersController@trash']);
	Route::resource('letters', 'LettersController');
	
	Route::post('users/undelete/{id}', ['as' => 'users.undelete', 'uses' => 'UsersController@undelete']);
	Route::resource('users', 'UsersController');
	
	Route::get('settings', ['as' => 'settings.index', 'uses' => 'SettingsController@index']);
	Route::post('settings/upload_image/', ['as' => 'settings.uploadImage', 'uses' => 'SettingsController@uploadImage']);
	Route::post('settings/delete_image/', ['as' => 'settings.deleteImage', 'uses' => 'SettingsController@deleteImage']);
	Route::post('settings/set_is_active/', ['as' => 'settings.setIsActive', 'uses' => 'SettingsController@setIsActive']);
	Route::post('settings/set_value/', ['as' => 'settings.setValue', 'uses' => 'SettingsController@setValue']);
	Route::get('settings/widgets', ['as' => 'settings.widgets', 'uses' => 'SettingsController@widgets']);
	Route::get('settings/checkout', ['as' => 'settings.checkout', 'uses' => 'SettingsController@checkout']);
	Route::get('settings/properties', ['as' => 'settings.properties', 'uses' => 'SettingsController@properties']);
	
	Route::post('menus/rename', ['as' => 'menus.rename', 'uses' => 'MenusController@rename']);
	Route::post('menus/delete', ['as' => 'menus.delete', 'uses' => 'MenusController@delete']);
	Route::post('menus/position', ['as' => 'menus.position', 'uses' => 'MenusController@changePosition']);
	Route::post('menus/add', ['as' => 'menus.add', 'uses' => 'MenusController@add']);
	Route::get('menus/autocomplete', ['as' => 'menus.autocomplete', 'uses' => 'MenusController@pagesAutocomplete']);
});