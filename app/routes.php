<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('prefix' => 'api'), function() {

	// since we will be using this just for CRUD, we won't need create and edit
	// Angular will handle both of those forms
	// this ensures that a user can't access api/create or api/edit when there's nothing there
	Route::resource('post', 'PostController',
		array('only' => array('index', 'store', 'update', 'destroy')));
	Route::resource('upload', 'UploadController',
		array('only' => array('store')));
	Route::resource('shop', 'ShopController',
		array('only' => array('index', 'store', 'update','destroy')));
	Route::resource('home', 'HomeController',
		array('only' => array('index', 'store', 'update', 'destroy')));
	Route::resource('user', 'UserController',
		array('only' => array('index', 'store', 'update', 'destroy')));
    Route::resource('follow', 'FollowController',
        array('only' => array('index', 'store', 'update', 'destroy')));
});

App::missing(function($exception) {
	return Redirect::to('/');
});
