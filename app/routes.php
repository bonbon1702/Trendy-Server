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
    echo "<h1>Hello</h1>";
});

Route::group(array('prefix' => 'api'), function() {

    //PostController
    Route::get('post/favorite/userId/{user_id}/postId/{post_id}/type/{type}', 'PostController@favoritePost');
    Route::delete('post/deletePostById/{id}', 'PostController@deletePostById');
    Route::get('post/getPostTrendy/paging/{id}/tag/{tag}', 'PostController@getPostTrendy');
    Route::get('post/getPostAround/paging/{id}/lat/{lat}/lng/{lng}', 'PostController@getPostAround');
    Route::get('post/getPostFavorite/paging/{id}/userId/{user_id}', 'PostController@getPostFavorite');
    Route::get('post/getPostNewFeed/paging/{id}/userId/{user_id}', 'PostController@getPostNewFeed');
    Route::post('post/createPost', 'PostController@createPost');
    Route::get('post/editPostCaption/id/{id}/caption/{caption}', 'PostController@editPostCaption');
    Route::get('post/getPostById/{id}', 'PostController@getPostById');


    //FavoriteController
    Route::get('favorite/userId/{user_id}/postId/{post_id}/type/{type}', 'FavoriteController@favoritePost');
    Route::resource('favorite', 'FavoriteController');


    //UploadController
	Route::post('uploadEditor', 'UploadController@uploadEditor');
    Route::post('upload/uploadPicture', 'UploadController@uploadPicture');


    //ShopController
	Route::get('shop/searchShop/{type}', 'ShopController@searchShop');
    Route::get('getShopList', 'ShopController@getShopList');
    Route::get('shop/getShop/{id}', 'ShopController@getShopByShopId');
    Route::get('shop/getShop/{id}/paging/{offSet}','ShopController@getShopPaging');
    Route::get('shop/suggestShop/loginId/{loginId}/shopId/{shopId}','ShopController@suggestShop');
    Route::post('shop/saveShopInfo','ShopController@saveShopDetailInfo');


    //UserController
    Route::get('searchAllPage/{type}','UserController@searchAllPage');
	Route::get('user/getUser/{id}', 'UserController@getUserInfo');
	Route::post('user/getLoginUser', 'UserController@getLoginUser');
	Route::delete('user/deleteLogoutUser/{id}', 'UserController@deleteLogoutUser');
    Route::post('user/createUser', 'UserController@createUser');


    //FollowController
	Route::get('follower/{user_id}', 'FollowController@followerByUser');
	Route::get('following/{follower_id}', 'FollowController@followingByUser');
    Route::post('follow/addFollowing', 'FollowController@addFollowing');
    Route::get('following/delete/userID/{user_id}/followerID/{follower_id}', 'FollowController@deleteFollowing');
    Route::get('follow/suggestionFollow/loginId/{loginId}/type/{type}/userId/{userId}', 'FollowController@suggestionFollow');


    //CommentController
	Route::get('comment/showPost/{id}', 'CommentController@showPost');
	Route::get('comment/showShop/{id}', 'CommentController@showShop');
    Route::get('comment/editPostComment/id/{id}/content/{content}', 'CommentController@editPostComment');
    Route::get('comment/deletePostComment/id/{id}', 'CommentController@deletePostComment');
    Route::post('comment/saveComment', 'CommentController@saveComment');
    Route::get('comment/editShopComment/id/{id}/content/{content}', 'CommentController@editShopComment');
    Route::get('comment/deleteShopComment/id/{id}', 'CommentController@deleteShopComment');


    //AlbumController
    Route::get('album/albumDetail/{id}', 'AlbumController@getAlbumDetail');
    Route::put('album/editAlbumById/{id}', 'AlbumController@editAlbumById');
    Route::resource('album', 'AlbumController');


    //TagController
    Route::get('tagContent/queryTag/{query}', 'TagContentController@queryTag');
    Route::get('tagContent/getAllTag', 'TagContentController@getAllTag');


    //LikeController
	Route::get('like/likePost/{id}/type/{type}/user/{user_id}', 'LikeController@likePost');
	Route::get('like/likeShop/{id}/type/{type}/user/{user_id}', 'LikeController@likeShop');
	Route::get('like/countLikePost/{id}', 'LikeController@countLikePost');
	Route::get('like/countLikeShop/{id}', 'LikeController@countLikeShop');


    //NotificationController
    Route::post('notification/watchedNotification', 'NotificationController@watchedNotification');
    Route::get('notification/getNotificationByUserId/{id}', 'NotificationController@getNotificationByUserId');
    Route::resource('notification', 'NotificationController');


    //AdminController
    Route::post('admin/adminLogin','AdminController@adminLogin');
    Route::get('admin/getAllUser','AdminController@getAllUser');
    Route::get('admin/banUser/{user_id}','AdminController@banUser');
    Route::get('admin/unBanUser/{user_id}','AdminController@unBanUser');
    Route::get('admin/getAllShop','AdminController@getAllShop');
    Route::get('admin/approveShop/{shop_detail_id}','AdminController@approveShop');
    Route::get('admin/unApproveShop/{shop_detail_id}','AdminController@unApproveShop');
    Route::get('admin/getAllPost','AdminController@getAllPost');
    Route::get('admin/deletePost/{post_id}','AdminController@deletePost');
    Route::get('admin/getInteractionLike','AdminController@getInteractionLike');
    Route::get('admin/getFavoriteInteraction','AdminController@getFavoriteInteraction');
    Route::get('admin/getCommentInteraction','AdminController@getCommentInteraction');
});

App::missing(function($exception) {
	return Redirect::to('/');
});
