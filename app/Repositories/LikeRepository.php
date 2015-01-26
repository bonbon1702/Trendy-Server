<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/26/2015
 * Time: 7:31 PM
 */

namespace Repositories;


use Core\BaseRepository;
use \Like;

class LikeRepository implements BaseRepository
{
    public function errors($code)
    {
        // TODO: Implement errors() method.
    }

    public function all(array $related = null)
    {
        // TODO: Implement all() method.
    }

    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        if ($id) {
            $like = Like::find($id);
        }
        return $like;
    }

    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
    }

    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)) {
            $like = Like::create($data);
        };

        return $like;
    }

    public function update($column, $value, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        $this->get($id)->delete();
    }

    public function deleteWhere($column, $value)
    {
        // TODO: Implement deleteWhere() method.
    }

    public function getUserLike($user_id, $type_like, $type_id)
    {
        $like = Like::where('user_id', $user_id)->where('type_like', $type_like)->where('type_id', $type_id)->first();

        return $like;
    }

    public function getLike($type_like, $type_id){
        $like = Like::where('type_like', $type_like)->where('type_id', $type_id);

        return $like;
    }

}