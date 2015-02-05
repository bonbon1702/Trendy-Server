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

class FollowService implements BaseService
{

    private $followRepository;

    function __construct(FollowRepository $followRepository)
    {
        // TODO: Implement __construct() method.
        $this->followRepository = $followRepository;
    }

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

    public function update(array $data)
    {
        // TODO: Implement update() method.
        return $this->followRepository->update('id', $data['id'], $data);
    }

    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
        $this->followRepository->deleteWhere($column, $value);
    }


    public function FollowingByUser($id)
    {
        return $this->followRepository->joinUserAndFollow()
            ->where('follower_id', '=' , $id)->get();
    }

    public function FollowerByUser($id)
    {
        return $this->followRepository->joinUserAndFollow()
            ->where('user_id', '=' , $id)->get();
    }
}