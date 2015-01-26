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

    function __construct(PostRepository $postRepository, UserRepository $userRepository, UploadRepository $uploadRepository, TagPictureService $tagPictureService, GoogleMapHelper $googleMapHelper, ShopService $shopService, AlbumService $albumService, CommentService $commentService, LikeService $likeService)
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
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        $upload_name = $data['name'];

        $caption = null;
        $points = array();
        $album_name = null;

        if ($data['caption']) $caption = $data['caption'];
        if (!empty($data['points'])) $points = $data['points'];
        if ($data['album']) $album_name = $data['album'];

        $user_id = $this->userRepository->getRecent()->id;

        $upload = $this->uploadRepository->getWhere('name', $upload_name);

        $post = $this->postRepository->create(array(
            'name' => Helper::get_rand_alphanumeric(8),
            'user_id' => $user_id,
            'image_url' => $upload->image_url,
            'image_url_editor' => $upload->image_url_editor,
            'caption' => $caption,
        ));

        if ($album_name) {
            $this->albumService->create(array(
                'postId' => $post->id,
                'aName' => $album_name
            ));
        }

        if ($points) {
            foreach ($points as $v) {
                $result = $this->googleMapHelper->findCoordinate($v['address']);

                $shop = $this->shopService->checkCoordinates($result);


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
    }

    public function update(array $data)
    {
        // TODO: Implement update() method.
        $update = $this->postRepository->update('name', $data['name'], $data);

        // next...
    }

    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
    }

    public function allPost()
    {
        $posts = $this->postRepository->all();
        foreach ($posts as $v){
            $v['user'] = $v->user;
        }

        return $posts;
    }

    public function getPostDetails($id){
        $post = $this->postRepository->get($id);
        $post['user'] = $post->user;
        $post['comments'] = $this->commentService->showCommentByPostId($id);
        $post['like'] = $this->likeService->countLike(0,$id);
        return $post;
    }
}