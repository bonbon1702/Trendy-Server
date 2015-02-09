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
use Repositories\PostAlbumRepository;
use Repositories\PostRepository;
use Services\ShopService;
use Repositories\UploadRepository;
use Repositories\UserRepository;
use Services\TagPictureService;

class PostService implements BaseService
{

    private $postRepository;

    private $userRepository;

    private $uploadRepository;

    private $tagPictureService;

    private $googleMapHelper;

    private $shopService;

    private $albumService;

    private $commentService;

    private $likeService;

    private $tagContentService;

    private $tagService;

    private $postAlbumRepository;

    function __construct(PostRepository $postRepository, UserRepository $userRepository, UploadRepository $uploadRepository, TagPictureService $tagPictureService, GoogleMapHelper $googleMapHelper, ShopService $shopService, AlbumService $albumService, CommentService $commentService, LikeService $likeService, TagContentService $tagContentService, TagService $tagService, PostAlbumRepository $postAlbumRepository)
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
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        $upload_name = $data['name'];

        $caption = null;
        $points = array();
        $album_name = null;
        $tags = array();

        if ($data['caption']) $caption = $data['caption'];
        if (!empty($data['points'])) $points = $data['points'];
        if ($data['album']) $album_name = $data['album'];
        if (!empty($data['tags'])) $tags = $data['tags'];

        $user_id = $data['user_id'];

        $upload = $this->uploadRepository->getWhere('name', $upload_name);
        $image_url_editor = null;

        if ($data['url']){
            $image_name = Helper::get_rand_alphanumeric(8);
            \Cloudy::upload($data['url'], $image_name);
            $image_url_editor = 'http://res.cloudinary.com/danpj76kz/image/upload/' . $image_name;
        } else {
            $image_url_editor = $upload->image_url;
        }

        if ($album_name) {
            $album = $this->albumService->create(array(
                'album_name' => $album_name,
                'user_id' => $user_id
            ));
        }

        $post = $this->postRepository->create(array(
            'name' => Helper::get_rand_alphanumeric(8),
            'user_id' => $user_id,
            'image_url' => $upload->image_url,
            'image_url_editor' => $image_url_editor,
            'caption' => $caption,
        ));

        if ($album_name && $post){
            $this->postAlbumRepository->create(array(
                'post_id' => $post->id,
                'album_id' => $album->id
            ));
        }

        if ($points) {
            foreach ($points as $v) {
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

        if ($tags){
            foreach ($tags as $v){
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

    public function update(array $data)
    {
        // TODO: Implement update() method.
        $update = $this->postRepository->update('id', $data['id'], $data);

        // next...
    }

    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
    }

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
        foreach ($post['tag'] as $v){
            $v['content'] = $v->tagContent;
        }
        return $post;
    }

    public function getPostPaging($order_by, $id){
        $posts = $this->postRepository->getRecent()->orderBy($order_by, 'DESC')->take(8)->skip($id)->get();

        foreach ($posts as $v) {
            $v['user'] = $v->user;
        }

        return $posts;
    }
}