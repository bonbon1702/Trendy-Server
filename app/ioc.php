<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 27/03/2015
 * Time: 21:15
 */

//Servies
App::bind('Services\\interfaces\\IAlbumService', 'Services\\AlbumService');
App::bind('Services\\interfaces\\ICommentService', 'Services\\CommentService');
App::bind('Services\\interfaces\\IFavoriteService', 'Services\\FavoriteService');
App::bind('Services\\interfaces\\IFollowService', 'Services\\FollowService');
App::bind('Services\\interfaces\\IHistoryService', 'Services\\HistoryService');
App::bind('Services\\interfaces\\ILikeService', 'Services\\LikeService');
App::bind('Services\\interfaces\\INotificationService', 'Services\\NotificationService');
App::bind('Services\\interfaces\\INotificationWatchedService', 'Services\\NotificationWatchedService');
App::bind('Services\\interfaces\\IPostService', 'Services\\PostService');
App::bind('Services\\interfaces\\IRoleUserService', 'Services\\RoleUserService');
App::bind('Services\\interfaces\\IShopDetailService', 'Services\\ShopDetailService');
App::bind('Services\\interfaces\\IShopService', 'Services\\ShopService');
App::bind('Services\\interfaces\\ITagPictureService', 'Services\\TagPictureService');
App::bind('Services\\interfaces\\IUploadService', 'Services\\UploadService');
App::bind('Services\\interfaces\\IUserService', 'Services\\UserService');
App::bind('Services\\interfaces\\ITagService', 'Services\\TagService');
App::bind('Services\\interfaces\\ITagContentService', 'Services\\TagContentService');
App::bind('Services\\interfaces\\IAdminService', 'Services\\AdminService');

//Repositories

App::bind('Repositories\\interfaces\\IAlbumRepository', 'Repositories\\AlbumRepository');
App::bind('Repositories\\interfaces\\ICommentRepository', 'Repositories\\CommentRepository');
App::bind('Repositories\\interfaces\\IFavoriteRepository', 'Repositories\\FavoriteRepository');
App::bind('Repositories\\interfaces\\IFollowRepository', 'Repositories\\FollowRepository');
App::bind('Repositories\\interfaces\\IHistoryRepository', 'Repositories\\HistoryRepository');
App::bind('Repositories\\interfaces\\ILikeRepository', 'Repositories\\LikeRepository');
App::bind('Repositories\\interfaces\\INotificationRepository', 'Repositories\\NotificationRepository');
App::bind('Repositories\\interfaces\\INotificationWatchedRepository', 'Repositories\\NotificationWatchedRepository');
App::bind('Repositories\\interfaces\\IPostAlbumRepository', 'Repositories\\PostAlbumRepository');
App::bind('Repositories\\interfaces\\IPostRepository', 'Repositories\\PostRepository');
App::bind('Repositories\\interfaces\\IRoleUserRepository', 'Repositories\\RoleUserRepository');
App::bind('Repositories\\interfaces\\IShopDetailRepository', 'Repositories\\ShopDetailRepository');
App::bind('Repositories\\interfaces\\IShopRepository', 'Repositories\\ShopRepository');
App::bind('Repositories\\interfaces\\ITagPictureRepository', 'Repositories\\TagPictureRepository');
App::bind('Repositories\\interfaces\\IUploadRepository', 'Repositories\\UploadRepository');
App::bind('Repositories\\interfaces\\IUserRepository', 'Repositories\\UserRepository');
App::bind('Repositories\\interfaces\\ITagRepository', 'Repositories\\TagRepository');
App::bind('Repositories\\interfaces\\ITagContentRepository', 'Repositories\\TagContentRepository');
App::bind('Repositories\\interfaces\\IAdminRepository', 'Repositories\\AdminRepository');


