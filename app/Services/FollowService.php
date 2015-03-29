<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:32 AM
 */

namespace Services;

use Core\ItemToItem;
use Repositories\interfaces\IFollowRepository;
use Repositories\interfaces\IUserRepository;
use Services\interfaces\IFollowService;

/**
 * Class FollowService
 * @package Services
 */
class FollowService implements IFollowService
{

    /**
     * @var FollowRepository
     */
    private $followRepository;

    /**
     * @var IUserRepository
     */
    private $userRepository;

    /**
     * @param IFollowRepository $followRepository
     * @param IUserRepository $userRepository
     */
    function __construct(IFollowRepository $followRepository, IUserRepository $userRepository)
    {
        // TODO: Implement __construct() method.
        $this->followRepository = $followRepository;
        $this->userRepository = $userRepository;
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        $userId = $data['user_id'];
        $followerId = $data['follower_id'];
        $follow = $this->followRepository->create(array(
            'user_id' => $userId,
            'follower_id' => $followerId,
        ));

        return $follow;
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

    /**
     * @param $id
     * @param $user_id
     * @return array
     */
    public function itemToItemFollow($id, $user_id){
        $users = $this->userRepository->getRecent()
                    ->select('users.id')
                    ->get();
        $matrix = array();
        foreach ($users as $v){
            $matrix[$v->id] = array();
            foreach ($users as $v1){
                $check = $this->followRepository->getRecent()
                    ->where('follower_id', $v->id)
                    ->where('user_id', $v1->id)
                    ->get();

                if (count($check) > 0) {
                    $matrix[$v->id][$v1->id] = 1;
                } else {
                    $matrix[$v->id][$v1->id] = 0;
                }
            }
        }
        $itemToItem = new ItemToItem();
        $itemToItem->insert($matrix);
        $results = $itemToItem->predict($id);


        $suggestions = array();
        foreach ($results as $k =>$v){
            $user = $this->userRepository->get($k);
            $user['cosine'] = $v;
            $suggestions[] = $user;
        }

        usort($suggestions, function ($item1, $item2) {
            $result = 0;
            if ($item1['cosine'] < $item2['cosine']) {
                $result = 1;
            } else if ($item1['cosine'] > $item2['cosine']) {
                $result = -1;
            }
            return $result;
        });

        $suggestions = array_slice($suggestions, 0, 3);

        return $suggestions;
    }

    /**
     * @param $user_id
     * @return array
     */
    public function popularFollow($user_id){
        $following = $this->FollowingByUser($user_id);

        $users =  $this->userRepository->getRecent()
            ->select('users.id','users.username', 'users.picture_profile')
            ->leftJoin('follow', 'users.id', '=' , 'follow.user_id')
            ->where('users.id', '<>', $user_id)
            ->groupBy('users.id')
            ->get();
        foreach($users as $v){
            $v['number_follow'] =  $this->followRepository->getRecent()
                        ->where('user_id', $v->id)
                        ->count();
        }

        foreach ($following as $f){
            foreach ($users as $k => $u) {
                if ($f->user_id == $u->id) unset($users[$k]);
            }
        }
        $users = $users->toArray();
        usort($users, function ($item1, $item2) {
            return $item2['number_follow'] - $item1['number_follow'];
        });

        $suggestions = array_slice($users, 0, 3);
        return $suggestions;
    }
}