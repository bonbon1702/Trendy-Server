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
	Route::get('post/getPost/{id}', 'PostController@getPost');
	Route::resource('post', 'PostController');
	Route::post('uploadEditor', 'UploadController@uploadEditor');
	Route::resource('upload', 'UploadController');
	Route::get('shop/searchShop/{type}', 'ShopController@searchShop');
	Route::resource('shop', 'ShopController');
	Route::resource('home', 'HomeController');
	Route::get('user/getUser/{id}', 'UserController@getUser');
	Route::get('user/getLoginUser', 'UserController@getLoginUser');
	Route::resource('user', 'UserController');
	Route::get('follower', 'FollowController@FollowerByUser');
	Route::get('following', 'FollowController@FollowingByUser');
    Route::resource('follow', 'FollowController');
	Route::get('comment/showPost/{id}', 'CommentController@showPost');
	Route::get('comment/showShop/{id}', 'CommentController@showShop');
    Route::resource('comment', 'CommentController');
    Route::get('album/albumContent/{id}/{name}', 'AlbumController@getAlbum');
    Route::resource('album', 'AlbumController');
	Route::resource('tag', 'TagController');
    Route::resource('tagContent', 'TagContentController');
	Route::get('like/likePost/{id}', 'LikeController@likePost');
	Route::get('like/likeShop/{id}', 'LikeController@likeShop');
	Route::get('like/countLikePost/{id}', 'LikeController@countLikePost');
	Route::get('like/countLikeShop/{id}', 'LikeController@countLikeShop');
	Route::get('like/checkLikePost/{id}', 'LikeController@checkLikePost');
	Route::get('like/checkLikeShop/{id}', 'LikeController@checkLikeShop');
	Route::resource('like', 'LikeController');
});

App::missing(function($exception) {
	return Redirect::to('/');
});
