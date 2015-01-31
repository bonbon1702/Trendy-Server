<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 11/3/2014
 * Time: 10:00 AM
 */

namespace Services;

use Core\BaseService;
use Repositories\UserRepository;

class UserService implements BaseService
{

    private $userRepository;

    function __construct(UserRepository $userRepository, FollowService $followService, PostService $postService, AlbumService $albumService)
    {
        $this->userRepository = $userRepository;
        $this->followService = $followService;
        $this->postService = $postService;
        $this->albumService = $albumService;
    }


    public function create(array $data)
    {
        // TODO: Implement create() method.
        return $this->userRepository->create($data);
    }

    public function update(array $data)
    {
        // TODO: Implement update() method.
    }


    public function delete($column, $value)
    {
        // TODO: Implement deleteWhere() method.
        $this->userRepository->deleteWhere($column, $value);

    }

    public function getUserInfo($id)
    {
        $user = $this->userRepository->get($id);
        $user['album'] = $user->album;
        $user['following'] = $this->followService->FollowingByUser($user->id);
        $user['follower'] = $this->followService->FollowerByUser($id);
        $user['posts'] = $user->posts;
        return $user;
    }
}