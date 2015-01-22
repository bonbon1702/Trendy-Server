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
		array('only' => array('store', 'update', 'show')));
	Route::resource('shop', 'ShopController',
		array('only' => array('index', 'store', 'update','destroy')));
	Route::resource('home', 'HomeController',
		array('only' => array('index', 'store', 'update', 'destroy')));
	Route::resource('user', 'UserController',
		array('only' => array('index', 'store', 'update', 'destroy')));
    Route::resource('follow', 'FollowController',
        array('only' => array('index', 'store', 'update', 'destroy')));
    Route::resource('comment', 'CommentController',
        array('only' => array('index', 'store', 'update', 'destroy')));
    Route::any('comment/showPost/{id}', 'CommentController@showPost');
    Route::any('comment/showShop/{id}', 'CommentController@showShop');
    Route::any('follower', 'FollowController@FollowerByUser');
    Route::any('following', 'FollowController@FollowingByUser');
		array('only' => array('index', 'store', 'destroy'));
    Route::any('album/albumContent/{id}/{name}', 'AlbumController@getAlbum');
    Route::resource('album', 'AlbumController');
	Route::any('shop/searchShop/{type}', 'ShopController@searchShop');
	Route::any('user/getLoginUser', 'UserController@getLoginUser');
	Route::resource('tag', 'TagController',
		array('only' => array('index', 'store', 'update', 'destroy')));
    Route::resource('tagContent', 'TagContentController',
        array('only' => array('index', 'store', 'update', 'destroy')));

});

App::missing(function($exception) {
	return Redirect::to('/');
});
