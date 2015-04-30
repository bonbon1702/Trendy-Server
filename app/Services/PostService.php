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
use \Image;

/**
 * Class PostService
 * @package Services
 */
class PostService implements IPostService{

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

    /**
     * @var IFavoriteRepository
     */
    private $favoriteRepository;

    /**
     * @var
     */
    private $tagService;

    /**
     * @var
     */
    private $tagContentService;

    /**
     * @var ITagRepository
     */
    private $tagRepository;

    /**
     * @var ITagContentRepository
     */
    private $tagContentRepository;

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
     * @param ITagContentRepository $tagContentRepository
     * @param ITagRepository $tagRepository
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
        $this->tagRepository = $tagRepository;
        $this->tagContentRepository =  $tagContentRepository;
    }

    /**
     * @param array $data
     */
    public function createPost(array $data)
    {
        // TODO: Implement create() method.
        $upload = $this->uploadRepository->getWhere('name', $data['name']);
        $image_url_editor = null;

        //check if user editor image
        if ($data['url'] != null) {
            $image = Image::make($data['url']);
            $image_name = date('Y') . '_' . date('m') . '_' .date('d'). '_' . Helper::get_rand_alphanumeric(8);
            $image_url = 'assets/images/'.$image_name.'.jpg';

            $image->save($image_url);
            $image_url_editor = url() . '/'. $image_url;
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
                $shop = $this->shopService->checkExist($image_url_editor,$v['address']);

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
     * @param $id
     * @param $tag
     * @return mixed
     */
    public function getPostTrendy($id, $tag){
        $order_by = 'zScore';
        if ($tag == 'all'){
            $posts = $this->postRepository->getRecent()
                ->orderBy($order_by, 'DESC')->take(8)->skip($id)->get();
            foreach ($posts as $v){
                $v['like'] = $this->likeService->countLike(0, $v->id);
                $v['favorite'] = $this->favoriteRepository->getRecent()
                    ->where('post_id', $v->id)->get();
            }
        } else {
            $posts = $this->postRepository->getRecent()
                ->join('tag', 'tag.post_id', '=', 'post.id')
                ->join('tag_content', 'tag_content.id', '=', 'tag.tag_content_id')
                ->where('tag_content.content', $tag)
                ->orderBy($order_by, 'DESC')->take(8)->skip($id)->get();

            foreach ($posts as $v){
                $v['like'] = $this->likeService->countLike(0, $v->post_id);
                $v['favorite'] = $this->favoriteRepository->getRecent()
                    ->where('post_id', $v->post_id)->get();
            }
        }

        foreach ($posts as $v) {
            $v['user'] = $v->user;
        }
        $results = $posts;

        return $results;
    }

    /**
     * @param $id
     * @param $lat
     * @param $long
     * @return array
     */
    public function getPostAround($id, $lat, $long){
        $posts = $this->postRepository->getRecent()
            ->select('post.*','shop.lat', 'shop.long')
            ->Join('tag_picture', 'tag_picture.post_id', '=', 'post.id')
            ->where('shop.lat' , '<>' , 'null')
            ->where('shop.long' , '<>' , 'null')
            ->Join('shop', 'shop.id', '=', 'tag_picture.shop_id')
            ->groupBy('post.id')
            ->get();
        foreach ($posts as $v) {
            $v['user'] = $v->user;
            $v['like'] = $this->likeService->countLike(0, $v->id);
            $v['favorite'] = $this->favoriteRepository->getRecent()
                ->where('post_id', $v->id)->get();
        }

        foreach ($posts as $k => $v){
            $posts[$k]->re_lat = abs($v->lat - $lat);
            $posts[$k]->re_long = abs($v->long - $long);
        }

        $posts = $posts->toArray();
        $posts_sort = array();
        foreach ($posts as $key => $row)
        {
            $posts_sort[$key] = $row['re_lat'];
            $posts_sort[$key] = $row['re_long'];
        }
        array_multisort($posts_sort, SORT_ASC, $posts);

        $results = array_slice($posts, $id, 8);

        return $results;
    }

    /**
     * @param $id
     * @param $user_id
     * @return mixed
     */
    public function getPostFavorite($id, $user_id){
        $posts = $this->favoriteRepository->getRecent()
            ->where('favorite.user_id', $user_id)
            ->join('post', 'favorite.post_id', '=', 'post.id')
            ->orderBy('post.created_at', 'DESC')->groupBy('post.id')
            ->take(8)->skip($id)->get();
        foreach ($posts as $v) {
            $v['user'] = $v->user;
            $v['like'] = $this->likeService->countLike(0, $v->id);
            $v['favorite'] = $this->favoriteRepository->getRecent()
                ->where('post_id', $v->id)->get();
        }
        $results = $posts;

        return $results;
    }

    /**
     * @param $id
     * @param $user_id
     * @return array
     */
    public function getPostNewFeed($id, $user_id){
        if ($this->userRepository->get($user_id)){
            $posts =  $this->followRepository->getRecent()
                ->select('*', 'post.created_at as time_created')
                ->where('follower_id', $user_id)
                ->join('post', 'follow.user_id', '=' , 'post.user_id')
                ->orderBy('post.created_at', 'DESC')->get();
            foreach ($posts as $v){
                $v['type'] = 'create';
                $v['user'] = $this->userRepository->get($v->user_id);
            }
            $post_comment = $this->followRepository->getRecent()
                ->select('*', 'comment.created_at as time_created', 'comment.user_id as actor_id')
                ->where('follower_id', $user_id)
                ->join('comment', 'follow.user_id', '=', 'comment.user_id')
                ->where('comment.type_comment',0)
                ->join('post', 'post.id', '=', 'comment.type_id')
                ->orderBy('comment.created_at', 'DESC')
                ->get();

            foreach ($post_comment as $v){
                $v['type'] = 'comment';
                $v['user'] = $this->userRepository->get($v->actor_id);
            }

            $post_like = $this->followRepository->getRecent()
                ->select('*', 'like.created_at as time_created', 'like.user_id as actor_id')
                ->where('follower_id', $user_id)
                ->join('like', 'follow.user_id', '=', 'like.user_id')
                ->where('like.type_like',0)
                ->join('post', 'post.id', '=', 'like.type_id')
                ->orderBy('like.created_at', 'DESC')
                ->get();

            foreach ($post_like as $v){
                $v['type'] = 'like';
                $v['user'] = $this->userRepository->get($v->actor_id);
            }

            $post_favorite = $this->followRepository->getRecent()
                ->select('*', 'favorite.created_at as time_created', 'favorite.user_id as actor_id')
                ->where('follower_id', $user_id)
                ->join('favorite', 'follow.user_id', '=', 'favorite.user_id')
                ->join('post', 'post.id', '=', 'favorite.post_id')
                ->orderBy('favorite.created_at', 'DESC')
                ->get();

            foreach ($post_favorite as $v){
                $v['type'] = 'favorite';
                $v['user'] = $this->userRepository->get($v->actor_id);
            }

            $posts = array_merge($posts->toArray(), $post_comment->toArray(), $post_like->toArray(), $post_favorite->toArray());

            //clear dup
            usort($posts, function ($a, $b){
                return strcmp($b['time_created'], $a['time_created']);
            });
            $k = 0;
            $results = array();
            foreach ($posts as $v){
                $results[$k] = $v;
                $results[$k]['like'] = $this->likeService->countLike(0, $v['id']);
                $results[$k]['favorite'] = $this->favoriteRepository->getRecent()
                    ->where('post_id', $v['id'])->get();
                $k++;
            }
            $results = array_slice($results, $id, 8);

            return $results;
        }
    }

    /**
     * @param $id
     */
    public function deletePost($id)
    {
        $this->postRepository->getRecent()->where("id", $id)->delete();
//        $this->postAlbumRepository->getRecent()->where('post_id', $id)->delete();
//        $this->commentService->deleteCommentInPost($id);
//        $this->favoriteService->deleteFavoriteInPost($id);
//        $this->likeService->deleteLikeInPost($id);
    }

    /**
     * @param $id
     * @param $caption
     * @return bool
     */
    public function editPostCaption($id, $caption){
        $post = $this->postRepository->update('id', $id , array(
            'caption' => $caption
        ));

        return true;
    }

}