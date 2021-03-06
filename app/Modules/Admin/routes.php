<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

Route::group(['module' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['web', 'auth'], 'namespace' => 'Modules\Admin\Controllers'], function () {
	
	Route::get('/', ['as' => 'index', 'uses' => 'AdminController@index']);
	
	Route::get('search', ['as' => 'search', 'uses' => 'AdminController@search']);
	
	Route::post('pages/change_published_status/{id}', ['as' => 'pages.changePublishedStatus', 'uses' => 'PagesController@changePublishedStatus']);
	Route::resource('pages', 'PagesController', ['except' => ['show']]);
	
	Route::resource('calls', 'RequestedCallsController', ['except' => ['create', 'store', 'show']]);
	
	Route::post('letters/change_important_status/{id}', ['as' => 'letters.changeImportantStatus', 'uses' => 'LettersController@changeImportantStatus']);
	Route::post('letters/undelete/{id}', ['as' => 'letters.undelete', 'uses' => 'LettersController@undelete']);
	Route::get('letters/important', ['as' => 'letters.important', 'uses' => 'LettersController@important']);
	Route::get('letters/trash', ['as' => 'letters.trash', 'uses' => 'LettersController@trash']);
	Route::resource('letters', 'LettersController', ['except' => ['edit', 'update', 'store', 'create']]);
	
	Route::post('users/undelete/{id}', ['as' => 'users.undelete', 'uses' => 'UsersController@undelete']);
	Route::resource('users', 'UsersController');
	
	Route::get('settings', ['as' => 'settings.index', 'uses' => 'SettingsController@index']);
	Route::post('settings/upload_image/', ['as' => 'settings.uploadImage', 'uses' => 'SettingsController@uploadImage']);
	Route::post('settings/delete_image/', ['as' => 'settings.deleteImage', 'uses' => 'SettingsController@deleteImage']);
	Route::post('settings/set_is_active/', ['as' => 'settings.setIsActive', 'uses' => 'SettingsController@setIsActive']);
	Route::post('settings/set_value/', ['as' => 'settings.setValue', 'uses' => 'SettingsController@setValue']);
	Route::get('settings/widgets', ['as' => 'settings.widgets', 'uses' => 'SettingsController@widgets']);
	Route::get('settings/advanced', ['as' => 'settings.advanced', 'uses' => 'SettingsController@advanced']);
	
	Route::post('menus/rename', ['as' => 'menus.rename', 'uses' => 'MenusController@rename']);
	Route::post('menus/delete', ['as' => 'menus.delete', 'uses' => 'MenusController@delete']);
	Route::post('menus/position', ['as' => 'menus.position', 'uses' => 'MenusController@changePosition']);
	Route::post('menus/add', ['as' => 'menus.add', 'uses' => 'MenusController@add']);
	Route::get('menus/autocomplete', ['as' => 'menus.autocomplete', 'uses' => 'MenusController@pagesAutocomplete']);
	
	Route::post('slider/upload_image/', ['as' => 'slider.uploadImage', 'uses' => 'SliderController@uploadImage']);
	Route::post('slider/delete_image/', ['as' => 'slider.deleteImage', 'uses' => 'SliderController@deleteImage']);
	Route::post('slider/set_is_active/', ['as' => 'slider.setIsActive', 'uses' => 'SliderController@setIsActive']);
	Route::post('slider/set_value/', ['as' => 'slider.setValue', 'uses' => 'SliderController@setValue']);
	Route::post('slider/position', ['as' => 'slider.position', 'uses' => 'SliderController@changePosition']);
	Route::resource('slider', 'SliderController', ['except' => ['index', 'edit', 'update', 'create', 'show']]);
	
	Route::post('reviews/upload_image/', ['as' => 'reviews.uploadImage', 'uses' => 'ReviewsController@uploadImage']);
	Route::post('reviews/delete_image/', ['as' => 'reviews.deleteImage', 'uses' => 'ReviewsController@deleteImage']);
	Route::post('reviews/set_is_active/', ['as' => 'reviews.setIsActive', 'uses' => 'ReviewsController@setIsActive']);
	Route::post('reviews/set_value/', ['as' => 'reviews.setValue', 'uses' => 'ReviewsController@setValue']);
	Route::post('reviews/position', ['as' => 'reviews.position', 'uses' => 'ReviewsController@changePosition']);
	Route::resource('reviews', 'ReviewsController', ['except' => ['index', 'edit', 'update', 'create', 'show']]);
	
	Route::post('team_members/upload_image/', ['as' => 'teamMembers.uploadImage', 'uses' => 'TeamMembersController@uploadImage']);
	Route::post('team_members/delete_image/', ['as' => 'teamMembers.deleteImage', 'uses' => 'TeamMembersController@deleteImage']);
	Route::post('team_members/set_is_active/', ['as' => 'teamMembers.setIsActive', 'uses' => 'TeamMembersController@setIsActive']);
	Route::post('team_members/set_value/', ['as' => 'teamMembers.setValue', 'uses' => 'TeamMembersController@setValue']);
	Route::post('team_members/position', ['as' => 'teamMembers.position', 'uses' => 'TeamMembersController@changePosition']);
	Route::resource('team_members', 'TeamMembersController', ['names' => ['store' => 'teamMembers.store', 'destroy' => 'teamMembers.destroy'], 'except' => ['index', 'edit', 'update', 'create', 'show']]);
	
	Route::post('partners/upload_image/', ['as' => 'partners.uploadImage', 'uses' => 'PartnersController@uploadImage']);
	Route::post('partners/delete_image/', ['as' => 'partners.deleteImage', 'uses' => 'PartnersController@deleteImage']);
	Route::post('partners/set_is_active/', ['as' => 'partners.setIsActive', 'uses' => 'PartnersController@setIsActive']);
	Route::post('partners/set_value/', ['as' => 'partners.setValue', 'uses' => 'PartnersController@setValue']);
	Route::post('partners/position', ['as' => 'partners.position', 'uses' => 'PartnersController@changePosition']);
	Route::resource('partners', 'PartnersController', ['names' => ['store' => 'partners.store', 'destroy' => 'partners.destroy'], 'except' => ['index', 'edit', 'update', 'create', 'show']]);
	
	Route::post('gallery/position', ['as' => 'gallery.position', 'uses' => 'GalleryController@changePosition']);
	Route::post('gallery/set_is_active/', ['as' => 'gallery.setIsActive', 'uses' => 'GalleryController@setIsActive']);
	Route::resource('gallery', 'GalleryController', ['except' => ['show']]);
});