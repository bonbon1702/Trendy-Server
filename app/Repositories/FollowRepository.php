<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:23 AM
 */

namespace Repositories;


use Core\BaseRepository;
use Follow as Follow;
use Repositories\interfaces\IFollowRepository;
use User as User;

/**
 * Class FollowRepository
 * @package Repositories
 */
class FollowRepository implements IFollowRepository
{
    /**
     * @param $code
     */
    public function errors($code)
    {
        // TODO: Implement errors() method.
    }

    /**
     * @param array $related
     * @return mixed
     */
    public function all(array $related = null)
    {
        // TODO: Implement all() method.
        $follow = Follow::all();
        return $follow;
    }

    /**
     * @param $id
     * @param array $related
     * @return mixed
     */
    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $follow = Follow::find($id);
        return $follow;
    }

    /**
     * @param $column
     * @param $value
     * @param array $related
     * @return mixed
     */
    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
        $follow = Follow::where($column, $value);
        return $follow;
    }

    /**
     * @param array $related
     * @return Follow
     */
    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
        $follow = new Follow();

        return $follow;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)) {
            $follow = Follow::create($data);
        }
        return $follow;
    }

    /**
     * @param $column
     * @param $value
     * @param array $data
     * @return mixed
     */
    public function update($column, $value, array $data)
    {
        // TODO: Implement update() method.
        if (!empty($data)) {
            $follow = $this->getWhere($column, $value)->update($data);
        }
        return $follow;
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
        $this->get($id)->delete();
    }

    /**
     * @param $column
     * @param $value
     */
    public function deleteWhere($column, $value)
    {
        // TODO: Implement deleteWhere() method.
        $this->getWhere($column, $value)->delete();
    }


    /**
     * @return mixed
     */
    public function joinFollowingByUser()
    {
        return User::join('follow', 'users.id', '=' , 'follow.user_id');
    }

    /**
     * @return mixed
     */
    public function joinFollowerByUser()
    {
        return User::join('follow', 'users.id', '=' , 'follow.follower_id');
    }
}