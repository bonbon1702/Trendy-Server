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

});

Route::group(array('prefix' => 'api'), function() {
    //PostController
    Route::get('post/favorite/userId/{user_id}/postId/{post_id}/type/{type}', 'PostController@favoritePost');
	Route::delete('post/delete/{id}', 'PostController@deletePost');
    Route::get('post/getPostTrendy/paging/{id}', 'PostController@getPostTrendy');
    Route::get('post/getPostAround/paging/{id}/lat/{lat}/lng/{lng}', 'PostController@getPostAround');
    Route::get('post/getPostFavorite/paging/{id}/userId/{user_id}', 'PostController@getPostFavorite');
    Route::get('post/getPostNewFeed/paging/{id}/userId/{user_id}', 'PostController@getPostNewFeed');
    Route::post('post/createPost', 'PostController@createPost');
	Route::resource('post', 'PostController');

    //FavoriteController
    Route::get('favorite/userId/{user_id}/postId/{post_id}/type/{type}', 'FavoriteController@favoritePost');
    Route::resource('favorite', 'FavoriteController');

    //UploadController
	Route::post('uploadEditor', 'UploadController@uploadEditor');
	Route::resource('upload', 'UploadController');


    //ShopController
	Route::get('shop/searchShop/{type}', 'ShopController@searchShop');
    Route::get('getShopList', 'ShopController@getShopList');
    Route::get('shop/getShop/{id}', 'ShopController@getShopByShopId');
    Route::get('shop/getShop/{id}/paging/{offSet}','ShopController@getShopPaging');
	Route::resource('shop', 'ShopController');
    Route::post('shop/saveShopInfo','ShopController@saveShopDetailInfo');


    //UserController
    Route::get('searchAllPage/{type}','UserController@searchAllPage');
	Route::get('user/getUser/{id}', 'UserController@getUser');
	Route::post('user/getLoginUser', 'UserController@getLoginUser');
	Route::delete('user/deleteLogoutUser/{id}', 'UserController@deleteLogoutUser');
	Route::resource('user', 'UserController');


    //FollowController
	Route::get('follower/{user_id}', 'FollowController@followerByUser');
	Route::get('following/{follower_id}', 'FollowController@followingByUser');
//	Route::delete('following/delete', 'FollowController@deleteFollowing');
    Route::get('following/delete/userID/{user_id}/followerID/{follower_id}', 'FollowController@deleteFollowing');
    Route::get('follow/suggestionFollow/{id}/type/{type}/userId/{userId}', 'FollowController@suggestionFollow');
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
    Route::get('tagContent/queryTag/{query}', 'TagContentController@queryTag');
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
