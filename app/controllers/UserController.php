<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 11/3/2014
 * Time: 10:23 AM
 */

use Repositories\UserRepository;
use Services\UserService;
use Services\ShopService;
use Services\FollowService;

/**
 * Class UserController
 */
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

    /**
     * @var ShopService
     */
    private $shopService;

    /**
     * @var FollowService
     */
    private $followService;

    /**
     * @param UserRepository $userRepository
     * @param UserService $userService
     * @param ShopService $shopService
     * @param FollowService $followService
     */
    public function __construct(UserRepository $userRepository, UserService $userService, ShopService $shopService, FollowService $followService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
        $this->shopService = $shopService;
        $this->followService = $followService;
    }

    /**
     * @return mixed
     */
    public function store()
    {
        $data = Input::all();

        $user = $this->userService->create($data);
        return Response::json(array(
            'success' => true,
            'user' => $user
        ));
    }

    /**
     * @return mixed
     */
    public function getLoginUser()
    {
        $data = Input::all();
        $user = $this->userRepository->getWhere('remember_token', $data['remember_token'])->first();
        return Response::json(array(
            'success' => true,
            'user' => $user
        ));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function  deleteLogoutUser($id)
    {
        $this->userService->delete('id', $id);

        return Response::json(array(
            'success' => true
        ));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUser($id)
    {
        $user = $this->userService->getUserInfo($id);
        return Response::json(array(
            'success' => true,
            'user' => $user
        ));
    }

    /**
     * @param $type
     * @return mixed
     */
    public function searchAllPage($type)
    {
        $user = $this->userService->searchFullText($type);
        $shop = $this->shopService->searchFullText($type);

        $results = array();
        foreach ($user as $v) {
            $count_follower = $this->followService->FollowerByUser($v->id)->count();
            $results[] = array(
                'name' => $v->username,
                'image' => $v->picture_profile,
                'sub' => $count_follower . ' Follower',
                'url' => 'user/' .$v->id
            );
        }

        foreach ($shop as $v) {
            $results[] = array(
                'name' => $v->name,
                'image' => $v->image_url,
                'sub' => $v->address,
                'url' => 'shop/' . $v->id
            );
        }
        return Response::json(array(
            'success' => true,
            'results' => $results
        ));
    }

    public function update($id){
        $data = Input::all();
        $data['id']=$id;
        $this->userService->update($data);
        return Response::json(array(
            'success' => true
        ));
    }
}