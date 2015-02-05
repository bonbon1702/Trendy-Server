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
use User as User;

class FollowRepository implements BaseRepository
{
    public function errors($code)
    {
        // TODO: Implement errors() method.
    }

    public function all(array $related = null)
    {
        // TODO: Implement all() method.
        $follow = Follow::all();
        return $follow;
    }

    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $follow = Follow::find($id);
        return $follow;
    }

    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
        $follow = Follow::where($column, $value);
        return $follow;
    }

    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.

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

    public function update($column, $value, array $data)
    {
        // TODO: Implement update() method.
        if (!empty($data)) {
            $follow = $this->getWhere($column, $value)->update($data);
        }
        return $follow;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        $this->get($id)->delete();
    }

    public function deleteWhere($column, $value)
    {
        // TODO: Implement deleteWhere() method.
        $this->getWhere($column, $value)->delete();
    }


    public function joinUserAndFollow()
    {
        return User::join('follow', 'users.id', '=' , 'follow.user_id');
    }
}