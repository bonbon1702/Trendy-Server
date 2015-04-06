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

    public function getAllUser(){
        $users = $this->adminService->getAllUser();
        return Response::json(array(
            'success' => true,
            'users' => $users
        ));
    }

}