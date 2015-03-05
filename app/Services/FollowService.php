<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:32 AM
 */

namespace Services;


use Core\BaseService;
use Repositories\FollowRepository;

/**
 * Class FollowService
 * @package Services
 */
class FollowService implements BaseService
{

    /**
     * @var FollowRepository
     */
    private $followRepository;

    /**
     * @param FollowRepository $followRepository
     */
    function __construct(FollowRepository $followRepository)
    {
        // TODO: Implement __construct() method.
        $this->followRepository = $followRepository;
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        $userId = $data['user_id'];
        $followerId = $data['follower_id'];
        $this->followRepository->create(array(
            'user_id' => $userId,
            'follower_id' => $followerId,
        ));

    }

    /**
     * @param array $data
     * @return mixed
     */
    public function update(array $data)
    {
        // TODO: Implement update() method.
        return $this->followRepository->update('id', $data['id'], $data);
    }

    /**
     * @param $column
     * @param $value
     */
    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
        $this->followRepository->deleteWhere($column, $value);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function deleteFollowing(array $data)
    {
        $user_id = $data['user_id'];
        $follower_id = $data['follower_id'];
        return $this->followRepository->getRecent()->where('follower_id', '=', $user_id)->where('user_id', '=', $follower_id)->delete();

    }

    /**
     * @param $id
     * @return mixed
     */
    public function FollowingByUser($id)
    {
        return $this->followRepository->joinFollowingByUser()
            ->where('follower_id', '=', $id)->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function FollowerByUser($id)
    {
        return $this->followRepository->joinFollowerByUser()
            ->where('user_id', '=', $id)->get();
    }
}