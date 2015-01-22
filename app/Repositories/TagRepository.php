<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:26 AM
 */

namespace Repositories;


use Core\BaseRepository;
use Tag as Tag;

class TagRepository implements BaseRepository
{
    public function errors($code)
    {
        // TODO: Implement errors() method.
    }

    public function all(array $related = null)
    {
        // TODO: Implement all() method.
        $tag = Tag::all();
        return $tag;
    }

    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $tag = Tag::get($id);
        return $tag;
    }

    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
        $tag = Tag::where($column, $value);
        return $tag;
    }

    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.

    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)) {
            $tag = Tag::create($data);
        }
        return $tag;
    }

    public function update($column, $value, array $data)
    {
        // TODO: Implement update() method.
        if(!empty($data)){
            $tag=$this->where($column,$value)->update($data);
        }
        return $tag;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        $tag=$this->get($id)->delete();
        return $tag;
    }

    public function deleteWhere($column, $value)
    {
        // TODO: Implement deleteWhere() method.
        $tag=$this->getWhere($column,$value)->delete();
        return $tag;
    }

}