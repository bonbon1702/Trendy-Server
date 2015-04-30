<?php

use Services\interfaces\IAdminService;

/**
 * Class AlbumController
 */
class AdminController extends \BaseController
{

    /**
     * @var IAlbumService
     */
    private $adminService;

    /**
     * @param IAdminService $adminService
     */
    function __construct(IAdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function adminLogin()
    {
        $data = Input::all();
        $result = $this->adminService->adminLogin($data);

        return Response::json(array(
            'user' => $result
        ));
    }

    public function getAllUser()
    {
        $users = $this->adminService->getAllUser();
        return Response::json(array(
            'success' => true,
            'users' => $users
        ));
    }

    public function banUser($user_id)
    {
        $this->adminService->banUser($user_id);

        return Response::json(array(
            'success' => true
        ));
    }

    public function unBanUser($user_id)
    {
        $this->adminService->unBanUser($user_id);

        return Response::json(array(
            'success' => true
        ));
    }

    public function getAllShop()
    {
        $shops = $this->adminService->getAllShop();
        return Response::json(array(
            'success' => true,
            'shops' => $shops
        ));
    }

    public function approveShop($shop_detail_id)
    {
        $this->adminService->approveShop($shop_detail_id);
        return Response::json(array(
            'success' => true
        ));
    }

    public function unApproveShop($shop_detail_id)
    {
        $this->adminService->unApproveShop($shop_detail_id);
        return Response::json(array(
            'success' => true
        ));
    }

    public function getAllPost()
    {
        $post = $this->adminService->getAllPost();
        return Response::json(array(
            'success' => true,
            'posts' => $post
        ));
    }

    public function deletePost($post_id){
        $this->adminService->deletePost($post_id);
        return Response::json(array(
            'success' => true
        ));
    }

    public function getInteractionLike(){
        $likeData = $this->adminService->getInteractionLike();
        return Response::json(array(
            'success' => true,
            'likeData' => $likeData
        ));
    }

    public function getFavoriteInteraction(){
        $favoriteData = $this->adminService->getFavoriteInteraction();
        return Response::json(array(
            'success' => true,
            'favoriteData' => $favoriteData
        ));
    }

    public function getCommentInteraction(){
        $commentData = $this->adminService->getCommentInteraction();
        return Response::json(array(
            'success' => true,
            'commentData' => $commentData
        ));
    }
}