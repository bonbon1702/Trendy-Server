<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:33 AM
 */

namespace Services;

use Core\GoogleMapHelper;
use Core\Helper;
use Repositories\interfaces\IAlbumRepository;
use Repositories\interfaces\IFavoriteRepository;
use Repositories\interfaces\IFollowRepository;
use Repositories\interfaces\IPostAlbumRepository;
use Repositories\interfaces\IPostRepository;
use Repositories\interfaces\ITagContentRepository;
use Repositories\interfaces\ITagRepository;
use Repositories\interfaces\IUploadRepository;
use Repositories\interfaces\IUserRepository;
use Services\interfaces\ITagContentService;
use Services\interfaces\ITagPictureService;
use Services\interfaces\IPostService;
use Services\interfaces\IShopService;
use Services\interfaces\IAlbumService;
use Services\interfaces\ICommentService;
use Services\interfaces\ILikeService;
use Services\interfaces\IFollowService;
use Services\interfaces\IFavoriteService;
use Services\interfaces\ITagService;

/**
 * Class PostService
 * @package Services
 */
class PostService implements IPostService
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

    private $favoriteRepository;

    private $tagService;

    private $tagContentService;

    private $tagRepository;

    /**
     * @param IPostRepository $postRepository
     * @param IUserRepository $userRepository
     * @param IUploadRepository $uploadRepository
     * @param ITagPictureService $tagPictureService
     * @param GoogleMapHelper $googleMapHelper
     * @param IShopService $shopService
     * @param IAlbumService $albumService
     * @param ICommentService $commentService
     * @param ILikeService $likeService
     * @param IPostAlbumRepository $postAlbumRepository
     * @param IAlbumRepository $albumRepository
     * @param IFollowService $followService
     * @param IFollowRepository $followRepository
     * @param IFavoriteService $favoriteService
     * @param IFavoriteRepository $favoriteRepository
     * @param ITagService $tagService
     * @param ITagContentService $tagContentService
     */
    function __construct(IPostRepository $postRepository, IUserRepository $userRepository, IUploadRepository $uploadRepository, ITagPictureService $tagPictureService, GoogleMapHelper $googleMapHelper, IShopService $shopService, IAlbumService $albumService, ICommentService $commentService, ILikeService $likeService, IPostAlbumRepository $postAlbumRepository, IAlbumRepository $albumRepository, IFollowService $followService, IFollowRepository $followRepository, IFavoriteService $favoriteService, IFavoriteRepository $favoriteRepository, ITagService $tagService, ITagContentService $tagContentService, ITagContentRepository $tagContentRepository, ITagRepository $tagRepository)
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
        $this->postAlbumRepository = $postAlbumRepository;
        $this->albumRespository = $albumRepository;
        $this->followService = $followService;
        $this->followRepository = $followRepository;
        $this->favoriteService = $favoriteService;
        $this->favoriteRepository = $favoriteRepository;
        $this->tagService = $tagContentService;
        $this->tagContentService = $tagContentService;
        $this->tagContentRepository = $tagContentRepository;
        $this->tagRepository = $tagRepository;
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
            $image = Image::make($data['url']);
            $image_name = date('Y') . '_' . date('m') . '_' .date('d'). '_' . Helper::get_rand_alphanumeric(8);
            $image_url = 'assets/images/'.$image_name.'.jpg';

            $image->save($image_url);
            $image_url_editor = url() . '/' . $image_name;
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

        if (!empty($data['tags'])) {
            foreach ($data['tags'] as $v) {
                $tagContent = $this->tagContentRepository->get($v['id']);
                $this->tagRepository->create(array(
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
            $results = $posts;
        } elseif ($order_by == "newfeed") {
            $posts =  $this->followRepository->getRecent()
                        ->where('follower_id', $user_id)
                        ->join('post', 'follow.user_id', '=' , 'post.user_id')
                        ->orderBy('post.created_at', 'DESC')->take(8)->skip($id)->get();
            $post_comment = $this->followRepository->getRecent()
                            ->where('follower_id', $user_id)
                            ->join('comment', 'follow.user_id', '=', 'comment.user_id')
                            ->where('comment.type_comment',0)
                            ->join('post', 'post.id', '=', 'comment.type_id')
                            ->orderBy('post.created_at', 'DESC')->groupBy('post.id')
                            ->take(8)->skip($id)->get();

            $posts = array_merge($posts->toArray(), $post_comment->toArray());

            //clear dup
            $results = array();
            foreach ($posts as $v){
                $results[$v['id']] = $v;
                $results[$v['id']]['user'] = $this->userRepository->get($v['user_id']);
            }
        } elseif ($order_by == 'favorite'){
            $posts = $this->favoriteRepository->getRecent()
                        ->where('favorite.user_id', $user_id)
                        ->join('post', 'favorite.post_id', '=', 'post.id')
                        ->orderBy('post.created_at', 'DESC')->groupBy('post.id')
                        ->take(8)->skip($id)->get();
            foreach ($posts as $v) {
                $v['user'] = $v->user;
            }
            $results = $posts;
        }

        return $results;
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