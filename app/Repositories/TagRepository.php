<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:26 AM
 */

namespace Repositories;

use Repositories\interfaces\ITagRepository;
use \Tag;

/**
 * Class TagRepository
 * @package Repositories
 */
class TagRepository implements ITagRepository
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
        $tag = Tag::all();
        return $tag;
    }

    /**
     * @param $id
     * @param array $related
     * @return mixed
     */
    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $tag = Tag::get($id);
        return $tag;
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
        $tag = Tag::where($column, $value);
        return $tag;
    }

    /**
     * @param array $related
     */
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
            $tag = Tag::create($data);
        }
        return $tag;
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
        if(!empty($data)){
            $tag=$this->where($column,$value)->update($data);
        }
        return $tag;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
        $tag=$this->get($id)->delete();
        return $tag;
    }

    /**
     * @param $column
     * @param $value
     * @return mixed
     */
    public function deleteWhere($column, $value)
    {
        // TODO: Implement deleteWhere() method.
        $tag=$this->getWhere($column,$value)->delete();
        return $tag;
    }

}