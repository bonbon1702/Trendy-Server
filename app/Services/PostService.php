<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:33 AM
 */

namespace Services;


use Core\BaseService;
use Core\GoogleMapHelper;
use Core\Helper;
use Repositories\AlbumRepository;
use Repositories\FollowRepository;
use Repositories\PostAlbumRepository;
use Repositories\PostRepository;
use Repositories\UploadRepository;
use Repositories\UserRepository;

/**
 * Class PostService
 * @package Services
 */
class PostService implements BaseService
{

    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var UploadRepository
     */
    private $uploadRepository;

    /**
     * @var TagPictureService
     */
    private $tagPictureService;

    /**
     * @var GoogleMapHelper
     */
    private $googleMapHelper;

    /**
     * @var ShopService
     */
    private $shopService;

    /**
     * @var AlbumService
     */
    private $albumService;

    /**
     * @var CommentService
     */
    private $commentService;

    /**
     * @var LikeService
     */
    private $likeService;

    /**
     * @var TagContentService
     */
    private $tagContentService;

    /**
     * @var TagService
     */
    private $tagService;

    /**
     * @var PostAlbumRepository
     */
    private $postAlbumRepository;

    /**
     * @var AlbumRepository
     */
    private $albumRespository;

    /**
     * @var FollowService
     */
    private $followService;

    /**
     * @param PostRepository $postRepository
     * @param UserRepository $userRepository
     * @param UploadRepository $uploadRepository
     * @param TagPictureService $tagPictureService
     * @param GoogleMapHelper $googleMapHelper
     * @param ShopService $shopService
     * @param AlbumService $albumService
     * @param CommentService $commentService
     * @param LikeService $likeService
     * @param TagContentService $tagContentService
     * @param TagService $tagService
     * @param PostAlbumRepository $postAlbumRepository
     * @param AlbumRepository $albumRepository
     */
    function __construct(PostRepository $postRepository, UserRepository $userRepository, UploadRepository $uploadRepository, TagPictureService $tagPictureService, GoogleMapHelper $googleMapHelper, ShopService $shopService, AlbumService $albumService, CommentService $commentService, LikeService $likeService, TagContentService $tagContentService, TagService $tagService, PostAlbumRepository $postAlbumRepository, AlbumRepository $albumRepository, FollowService $followService, FollowRepository $followRepository, FavoriteService $favoriteService)
    {
        // TODO: Implement __construct() method.
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
        $this->uploadRepository = $uploadRepository;
        $this->tagPictureService = $tagPictureService;
        $this->googleMapHelper = $googleMapHelper;
        $this->shopService = $shopService;
        $this->albumService = $albumService;
        $this->commentService = $commentService;
        $this->likeService = $likeService;
        $this->tagContentService = $tagContentService;
        $this->tagService = $tagService;
        $this->postAlbumRepository = $postAlbumRepository;
        $this->albumRespository = $albumRepository;
        $this->followService = $followService;
        $this->followRepository = $followRepository;
        $this->favoriteService = $favoriteService;
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        $upload = $this->uploadRepository->getWhere('name', $data['name']);
        $image_url_editor = null;

        //check if user editor image
        if ($data['url']) {
            $image_name = Helper::get_rand_alphanumeric(8);
            \Cloudy::upload($data['url'], $image_name);
            $image_url_editor = 'http://res.cloudinary.com/danpj76kz/image/upload/' . $image_name;
        } else {
            $image_url_editor = $upload->image_url;
        }

        $post = $this->postRepository->create(array(
            'name' => Helper::get_rand_alphanumeric(8),
            'user_id' => $data['user_id'],
            'image_url' => $upload->image_url,
            'image_url_editor' => $image_url_editor,
            'caption' => $data['caption'] ? $data['caption'] : '',
        ));

        if ($data['album'] && $post) {
            $album = $this->albumService->create(array(
                'album_name' => $data['album'],
                'user_id' => $data['user_id']
            ));

            $this->postAlbumRepository->create(array(
                'post_id' => $post->id,
                'album_id' => $album->id
            ));
        }

        if (!empty($data['points'])) {
            foreach ($data['points'] as $v) {
                $shop = $this->shopService->checkExist($v['address']);

                $this->tagPictureService->create(array(
                    'post_id' => $post->id,
                    'name' => $v['name'],
                    'price' => $v['price'],
                    'top' => $v['top'],
                    'left' => $v['left'],
                    'shop_id' => $shop->id
                ));
            }
        }

        if ($data['tags']) {
            foreach ($data['tags'] as $v) {
                $tagContent = $this->tagContentService->create(array(
                    'content' => $v['text']
                ));
                $this->tagService->create(array(
                    'post_id' => $post->id,
                    'tag_content_id' => $tagContent->id
                ));
            }
        }
    }

    /**
     * @param array $data
     */
    public function update(array $data)
    {
        // TODO: Implement update() method.
        $update = $this->postRepository->update('id', $data['id'], $data);

        // next...
    }

    /**
     * @param $column
     * @param $value
     */
    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
        $this->postRepository->deleteWhere($column, $value);

    }

    /**
     * @return mixed
     */
    public function allPost()
    {
        $posts = $this->postRepository->all();
        foreach ($posts as $v) {
            $v['user'] = $v->user;
            $v['comments'] = $this->commentService->showCommentByPostId($v->id);
            $v['like'] = $this->likeService->countLike(0, $v->id);
            $v['tag_picture'] = $v->tagPicture;
            foreach ($v['tag_picture'] as $t) {
                $t['shop'] = $t->shop;
            }
            $v['tag'] = $v->tag;
            foreach ($v['tag'] as $t) {
                $t['content'] = $t->shop;
            }
        }

        return $posts;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPostDetails($id)
    {
        $post = $this->postRepository->get($id);
        $post['user'] = $post->user;

        $post['comments'] = $this->commentService->showCommentByPostId($id);
        $post['like'] = $this->likeService->countLike(0, $id);
        $post['tag_picture'] = $post->tagPicture;
        foreach ($post['tag_picture'] as $v) {
            $v['shop'] = $v->shop;
        }
        $post['tag'] = $post->tag;
        foreach ($post['tag'] as $v) {
            $v['content'] = $v->tagContent;
        }
        $post['favorite'] = $this->favoriteService->getUserFavorite($id);
        return $post;
    }

    /**
     * @param $order_by
     * @param $id
     * @return mixed
     */
    public function getPostPaging($order_by, $id, $user_id)
    {
        if ($order_by == "zScore"){
            $posts = $this->postRepository->getRecent()->orderBy($order_by, 'DESC')->take(8)->skip($id)->get();

            foreach ($posts as $v) {
                $v['user'] = $v->user;
            }
        } elseif ($order_by == "newfeed") {
            $posts =  $this->followRepository->getRecent()
                        ->where('follower_id', $user_id)
                        ->join('post', 'follow.user_id', '=' , 'post.user_id')
                        ->orderBy('post.created_at', 'DESC')->take(8)->skip($id)->get();

            foreach ($posts as $v) {
                $v['user'] = $v->user;
            }
        }

        return $posts;
    }

    /**
     * @param $id
     */
    public function deletePost($id)
    {
        $this->postRepository->delete($id);
        $this->postAlbumRepository->getRecent()->where('post_id', $id)->delete();
        $this->commentService->deleteCommentInPost($id);
    }
}