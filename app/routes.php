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

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('countZScore','HomeController@zScore');

Route::group(array('prefix' => 'api'), function() {

	// since we will be using this just for CRUD, we won't need create and edit
	// Angular will handle both of those forms
	// this ensures that a user can't access api/create or api/edit when there's nothing there
	Route::get('post/getPost/order/{order_by}/paging/{id}', 'PostController@getPost');
	Route::resource('post', 'PostController');
	Route::post('uploadEditor', 'UploadController@uploadEditor');
	Route::resource('upload', 'UploadController');
	Route::get('shop/searchShop/{type}', 'ShopController@searchShop');
	Route::resource('shop', 'ShopController');
	Route::resource('home', 'HomeController');
	Route::get('user/getUser/{id}', 'UserController@getUser');
	Route::post('user/getLoginUser', 'UserController@getLoginUser');
	Route::delete('user/deleteLogoutUser/{id}', 'UserController@deleteLogoutUser');
	Route::resource('user', 'UserController');
	Route::get('follower/{user_id}', 'FollowController@followerByUser');
	Route::get('following/{follower_id}', 'FollowController@followingByUser');
	Route::delete('following/delete', 'FollowController@deleteFollowing');
    Route::resource('follow', 'FollowController');
	Route::get('comment/showPost/{id}', 'CommentController@showPost');
	Route::get('comment/showShop/{id}', 'CommentController@showShop');
    Route::resource('comment', 'CommentController');
    Route::get('album/albumContent/{id}/{name}', 'AlbumController@getAlbum');
    Route::resource('album', 'AlbumController');
	Route::resource('tag', 'TagController');
    Route::resource('tagContent', 'TagContentController');
	Route::get('like/likePost/{id}/type/{type}/user/{user_id}', 'LikeController@likePost');
	Route::get('like/likeShop/{id}/type/{type}/user/{user_id}', 'LikeController@likeShop');
	Route::get('like/countLikePost/{id}', 'LikeController@countLikePost');
	Route::get('like/countLikeShop/{id}', 'LikeController@countLikeShop');
	Route::resource('like', 'LikeController');
});

App::missing(function($exception) {
	return Redirect::to('/');
});
