<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 11/3/2014
 * Time: 10:00 AM
 */

namespace Services;

use Repositories\interfaces\IUserRepository;
use Services\interfaces\IAlbumService;
use Services\interfaces\IFollowService;
use Services\interfaces\IPostService;
use Services\interfaces\IUserService;

/**
 * Class UserService
 * @package Services
 */
class UserService implements IUserService
{

    /**
     * @var UserRepository
     */
    private $userRepository;


    /**
     * @param IUserRepository $userRepository
     * @param IFollowService $followService
     * @param IPostService $postService
     * @param IAlbumService $albumService
     */
    function __construct(IUserRepository $userRepository, IFollowService $followService, IPostService $postService, IAlbumService $albumService)
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
                    'remember_token' => $data['remember_token'],
                    'image_cover' => url() . '/assets/cover-facebook-1.jpg'
                ));
                $album = $this->albumService->create(array(
                    'user_id' => $user->id,
                    'album_name' => 'favorite'
                ));
            } else {
                $user = $this->userRepository->update('email', $data['email'], array(
                    'remember_token' => $data['remember_token'],
                    'sw_id' => $data['sw_id']
                ));
            }
        }
        return $user;
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function changeCover(array $data)
    {
        // TODO: Implement update() method.
        return $this->userRepository->update('id', $data['id'], $data);
    }


    /**
     * @param $column
     * @param $value
     */
    public function deleteLogoutUser($column, $value)
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
        foreach ($user['album'] as $v) {
            $v['album_detail'] = $this->albumService->getAlbumDetail($v->album_name, $user->id);
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
    public function searchFullText($type)
    {
        $users = $this->userRepository->getRecent()
            ->where('username', 'LIKE', '%' . $type . '%')->get();

        return $users;
    }

    /**
     * @return mixed
     */
    public function getAllUser()
    {
        $users = $this->userRepository->all();

        return $users;
    }
}