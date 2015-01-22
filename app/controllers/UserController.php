<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 11/3/2014
 * Time: 10:23 AM
 */

use Repositories\UserRepository;
use Services\UserService;

class UserController extends BaseController
{
    /**
     * @var userRepository
     */
    private $userRepository;
    /**
     * @var user Service
     */
    private $userService;

    public function __construct(UserRepository $userRepository, UserService $userService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    public function store(){
        $data = Input::all();

        $user = $this->userService->create($data);
        return Response::json(array(
            'success' => true,
            'user' => $user
        ));
    }

    public function getLoginUser(){
        $user = $this->userRepository->getRecent();

        return Response::json(array(
            'success' => true,
            'user' => $user
        ));
    }

}