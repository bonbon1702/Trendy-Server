<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/26/2015
 * Time: 7:31 PM
 */

namespace Repositories;


use Like;
use Repositories\interfaces\ILikeRepository;

/**
 * Class LikeRepository
 * @package Repositories
 */
class LikeRepository implements ILikeRepository
{

    /**
     * @param $id
     * @param array $related
     * @return mixed
     */
    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        if ($id) {
            $like = Like::find($id);
        }
        return $like;
    }

    /**
     * @param $column
     * @param $value
     * @param array $related
     */
    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
    }

    /**
     * @param array $related
     */
    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
        $like = new Like();

        return $like;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)) {
            $like = Like::create($data);
        };

        return $like;
    }

    /**
     * @param $column
     * @param $value
     * @param array $data
     */
    public function update($column, $value, array $data)
    {
        // TODO: Implement update() method.
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
    }

    /**
     * @param $user_id
     * @param $type_like
     * @param $type_id
     * @return mixed
     */
    public function getUserLike($user_id, $type_like, $type_id)
    {
        $like = Like::where('user_id', $user_id)->where('type_like', $type_like)->where('type_id', $type_id)->first();

        return $like;
    }

    /**
     * @param $type_like
     * @param $type_id
     * @return mixed
     */
    public function getLike($type_like, $type_id)
    {
        $like = Like::where('type_like', $type_like)->where('type_id', $type_id);

        return $like;
    }

}