<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:19 AM
 */

namespace Repositories;


use Core\BaseRepository;

class CommentRepository implements BaseRepository{
    public function errors($code)
    {
        // TODO: Implement errors() method.
    }

    public function all(array $related = null)
    {
        // TODO: Implement all() method.
        $comment = Comment::all();
        return $comment;
    }

    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $comment = Comment::find($id);
        return $comment;
    }

    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
        $comment = Comment::where($column,$value);
        return $comment;
    }

    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)){
            $comment = Comment::create($data);
        }
        return $comment;
    }

    public function update($model, array $data)
    {
        // TODO: Implement update() method.
        if (!empty($data)){
            $comment = Comment::update($data);
        }
        return $comment;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        $this->get($id)->delete();
    }

    public function deleteWhere($column, $value)
    {
        // TODO: Implement deleteWhere() method.
        $this->getWhere($column,$value)->delete();
    }

}