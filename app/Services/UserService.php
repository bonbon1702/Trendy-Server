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

/**
 * Class UserService
 * @package Services
 */
class UserService implements BaseService
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     * @param FollowService $followService
     * @param PostService $postService
     * @param AlbumService $albumService
     */
    function __construct(UserRepository $userRepository, FollowService $followService, PostService $postService, AlbumService $albumService)
    {
        $this->userRepository = $userRepository;
        $this->followService = $followService;
        $this->postService = $postService;
        $this->albumService = $albumService;
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)) {

            $user = $this->userRepository->getWhere('email', $data['email'])->first();

            if (!$user) {
                $user = $this->userRepository->create(array(
                    'email' => $data['email'],
                    'username' => $data['username'],
                    'picture_profile' => $data['avatar'],
                    'sw_id' => $data['sw_id'],
                    'gender' => $data['gender'],
                    'delete_flag' => 0,
                    'role_id' => 1,
                    'remember_token' => $data['remember_token']
                ));
            } else {
                $user = $this->userRepository->update('email', $data['email'], array(
                    'remember_token' => $data['remember_token']
                ));
            }
        }
        return $user;
    }

    /**
     * @param array $data
     */
    public function update(array $data)
    {
        // TODO: Implement update() method.
    }


    /**
     * @param $column
     * @param $value
     */
    public function delete($column, $value)
    {
        // TODO: Implement deleteWhere() method.
        $this->userRepository->deleteWhere($column, $value);

    }

    /**
     * @param $id
     * @return null
     */
    public function getUserInfo($id)
    {
        $user = $this->userRepository->get($id);
        $user['album'] = $this->albumService->getAlbum($user->id);
        foreach($user['album'] as $v){
            $v['album_detail']=$this->albumService->getAlbumDetail($v->album_name,$user->id);
        }
        $user['following'] = $this->followService->FollowingByUser($user->id);
        $user['follower'] = $this->followService->FollowerByUser($id);
        $user['posts'] = $user->posts;
        return $user;
    }

    /**
     * @param $type
     * @return mixed
     */
    public function searchFullText($type){
        $users = $this->userRepository->getRecent()
            ->where('username', 'LIKE', '%'.$type.'%')->get();

        return $users;
    }

    public function getAllUser(){
        $users = $this->userRepository->all();

        return $users;
    }
}