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

    //HomeController
    Route::resource('home', 'HomeController');


    //PostController
	Route::get('post/getPost/order/{order_by}/paging/{id}', 'PostController@getPost');
	Route::resource('post', 'PostController');
	Route::delete('post/delete/{id}', 'PostController@deletePost');


    //UploadController
	Route::post('uploadEditor', 'UploadController@uploadEditor');
	Route::resource('upload', 'UploadController');


    //ShopController
	Route::get('shop/searchShop/{type}', 'ShopController@searchShop');
	Route::resource('shop', 'ShopController');
    Route::get('shop/getShop/{id}/paging/{offSet}','ShopController@getShopPaging');


    //UserController
    Route::get('searchAllPage/{type}','UserController@searchAllPage');
	Route::get('user/getUser/{id}', 'UserController@getUser');
	Route::post('user/getLoginUser', 'UserController@getLoginUser');
	Route::delete('user/deleteLogoutUser/{id}', 'UserController@deleteLogoutUser');
	Route::resource('user', 'UserController');


    //FollowController
	Route::get('follower/{user_id}', 'FollowController@followerByUser');
	Route::get('following/{follower_id}', 'FollowController@followingByUser');
	Route::delete('following/delete', 'FollowController@deleteFollowing');
    Route::get('follow/suggestionFollow/{id}', 'FollowController@suggestionFollow');
    Route::resource('follow', 'FollowController');


    //CommentController
	Route::get('comment/showPost/{id}', 'CommentController@showPost');
	Route::get('comment/showShop/{id}', 'CommentController@showShop');
    Route::resource('comment', 'CommentController');


    //AlbumController
    Route::get('album/albumDetail/{id}', 'AlbumController@getAlbumDetail');
    Route::resource('album', 'AlbumController');
	Route::delete('album/delete/{name}', 'AlbumController@deleteAlbum');


    //TagController
	Route::resource('tag', 'TagController');
    Route::resource('tagContent', 'TagContentController');


    //LikeController
	Route::get('like/likePost/{id}/type/{type}/user/{user_id}', 'LikeController@likePost');
	Route::get('like/likeShop/{id}/type/{type}/user/{user_id}', 'LikeController@likeShop');
	Route::get('like/countLikePost/{id}', 'LikeController@countLikePost');
	Route::get('like/countLikeShop/{id}', 'LikeController@countLikeShop');
	Route::resource('like', 'LikeController');


    //NotificationController
    Route::post('notification/watchedNotification', 'NotificationController@watchedNotification');
    Route::resource('notification', 'NotificationController');

});

App::missing(function($exception) {
	return Redirect::to('/');
});
