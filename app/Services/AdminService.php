<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 05/04/2015
 * Time: 16:15
 */

namespace Services;


use Repositories\interfaces\IAdminRepository;
use Repositories\interfaces\ILikeRepository;
use Repositories\interfaces\IPostAlbumRepository;
use Repositories\interfaces\IPostRepository;
use Repositories\interfaces\IShopDetailRepository;
use Repositories\interfaces\IShopRepository;
use Repositories\interfaces\IUserRepository;
use Services\interfaces\IAdminService;
use Services\interfaces\ICommentService;
use Services\interfaces\IFavoriteService;
use Services\interfaces\IHistoryService;
use Services\interfaces\ILikeService;

/**
 * Class AdminService
 * @package Services
 */
class AdminService implements IAdminService
{

    /**
     * @var IAdminRepository
     */
    private $adminRepository;

    /**
     * @var IUserRepository
     */
    private $userRepository;

    /**
     * @var IShopRepository
     */
    private $shopRepository;

    /**
     * @var IShopDetailRepository
     */
    private $shopDetailRepository;

    /**
     * @var IPostRepository
     */
    private $postRepository;

    /**
     * @var PostAlbumRepository
     */
    private $postAlbumRepository;

    /**
     * @var CommentService
     */
    private $commentService;

    /**
     * @var IFavoriteService
     */
    private $favoriteService;

    /**
     * @var ILikeService
     */
    private $likeService;

    /**
     * @var ILikeRepository
     */
    private $likeRepository;

    /**
     * @var IHistoryService
     */
    private $historyService;

    /**
     * @param IAdminRepository $adminRepository
     * @param IUserRepository $userRepository
     * @param IShopRepository $shopRepository
     * @param IShopDetailRepository $shopDetailRepository
     * @param IPostRepository $postRepository
     * @param IPostAlbumRepository $postAlbumRepository
     * @param ICommentService $commentService
     * @param IFavoriteService $favoriteService
     * @param ILikeService $likeService
     * @param ILikeRepository $likeRepository
     * @param IHistoryService $historyService
     */
    function __construct(IAdminRepository $adminRepository, IUserRepository $userRepository, IShopRepository $shopRepository, IShopDetailRepository $shopDetailRepository, IPostRepository $postRepository, IPostAlbumRepository $postAlbumRepository, ICommentService $commentService, IFavoriteService $favoriteService,ILikeService $likeService, ILikeRepository $likeRepository, IHistoryService $historyService)
    {
        $this->adminRepository = $adminRepository;
        $this->userRepository = $userRepository;
        $this->shopRepository = $shopRepository;
        $this->shopDetailRepository = $shopDetailRepository;
        $this->postRepository = $postRepository;
        $this->postAlbumRepository = $postAlbumRepository;
        $this->commentService = $commentService;
        $this->favoriteService = $favoriteService;
        $this->likeService=$likeService;
        $this->likeRepository = $likeRepository;
        $this->historyService = $historyService;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function adminLogin($data)
    {
        $result = $this->adminRepository->getRecent()
            ->where('username', $data['username'])
            ->where('password', $data['password'])
            ->first();
        return $result;
    }

    /**
     * @return mixed
     */
    public function getAllUser()
    {
        $users = $this->userRepository->all();

        return $users;
    }

    /**
     * @param $user_id
     * @return bool
     */
    public function banUser($user_id)
    {
        // TODO: Implement banUser() method.
        $this->userRepository->update('id', $user_id, array(
            'delete_flag' => 1
        ));

        return true;
    }

    /**
     * @param $user_id
     * @return bool
     */
    public function unBanUser($user_id)
    {
        // TODO: Implement unBanUser() method.
        $this->userRepository->update('id', $user_id, array(
            'delete_flag' => 0
        ));

        return true;
    }

    /**
     * @return mixed
     */
    public function getAllShop()
    {
        $shops = $this->shopRepository->getRecent()
            ->select('shop_detail.*')
            ->join('shop_detail', 'shop_detail.shop_id', '=', 'shop.id')
            ->get();

        return $shops;
    }

    /**
     * @param $shop_detail_id
     * @return bool
     */
    public function approveShop($shop_detail_id)
    {
        $this->shopDetailRepository->update('id', $shop_detail_id, array(
            'approve' => 1
        ));
        $this->shopDetailRepository->getRecent()->where('id', '<>', $shop_detail_id)->update(array(
            'approve' => 0
        ));
        return true;
    }

    /**
     * @param $shop_detail_id
     * @return bool
     */
    public function unApproveShop($shop_detail_id)
    {
        $this->shopDetailRepository->update('id', $shop_detail_id, array(
            'approve' => 0
        ));
        return true;
    }

    /**
     * @return mixed
     */
    public function getAllPost()
    {
        $post = $this->postRepository->all();
        return $post;
    }

    /**
     * @param $post_id
     * @return bool
     */
    public function deletePost($post_id)
    {
        $this->postRepository->getRecent()->where("id", $post_id);
        $this->postAlbumRepository->getRecent()->where('post_id', $post_id)->delete();
        $this->commentService->deleteCommentInPost($post_id);
        $this->favoriteService->deleteFavoriteInPost($post_id);
        $this->likeService->deleteLikeInPost($post_id);
        return true;
    }


    public function getInteractionLike(){
        $posts = $this->postRepository->getRecent()
        ->orderBy("zScore", "DESC")->take(5)->get();
        $matrix = array();
        $i = 9;
        while(true){
            if ($i == -1) break;
            $start_day = date("Y-m-d", time() - 86400 * $i) . " 00:00:00";
            $end_day = date("Y-m-d", time() - 86400 * $i) . " 23:59:59";
            $matrix['vector'][date("m-d", time() - 86400 * $i)] = array();
            foreach ($posts as $v){
                $like_count = $this->historyService->actionCount('like', $v->id, $start_day, $end_day);

                $matrix['vector'][date("m-d", time() - 86400 * $i)][] = $like_count;
            }

            $i--;
        }
        foreach ($posts as $v){
            $matrix['posts'][] = $v->id;
        }
        array_reverse($matrix['vector'],true);
        return $matrix;
    }

    public function getFavoriteInteraction(){
        $posts = $this->postRepository->getRecent()
            ->orderBy("zScore", "DESC")->take(5)->get();
        $matrix = array();
        $i = 9;
        while(true){
            if ($i == -1) break;
            $start_day = date("Y-m-d", time() - 86400 * $i) . " 00:00:00";
            $end_day = date("Y-m-d", time() - 86400 * $i) . " 23:59:59";
            $matrix['vector'][date("m-d", time() - 86400 * $i)] = array();
            foreach ($posts as $v){
                $like_count = $this->historyService->actionCount('favorite', $v->id, $start_day, $end_day);

                $matrix['vector'][date("m-d", time() - 86400 * $i)][] = $like_count;
            }

            $i--;
        }
        foreach ($posts as $v){
            $matrix['posts'][] = $v->id;
        }

        return $matrix;
    }

    public function getCommentInteraction(){
        $posts = $this->postRepository->getRecent()
            ->orderBy("zScore", "DESC")->take(5)->get();
        $matrix = array();
        $i = 9;
        while(true){
            if ($i == -1) break;
            $start_day = date("Y-m-d", time() - 86400 * $i) . " 00:00:00";
            $end_day = date("Y-m-d", time() - 86400 * $i) . " 23:59:59";
            $matrix['vector'][date("m-d", time() - 86400 * $i)] = array();
            foreach ($posts as $v){
                $like_count = $this->historyService->actionCount('comment', $v->id, $start_day, $end_day);

                $matrix['vector'][date("m-d", time() - 86400 * $i)][] = $like_count;
            }

            $i--;
        }
        foreach ($posts as $v){
            $matrix['posts'][] = $v->id;
        }

        return $matrix;
    }
}