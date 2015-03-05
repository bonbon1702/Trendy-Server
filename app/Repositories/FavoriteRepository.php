<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/26/2015
 * Time: 7:31 PM
 */

namespace Repositories;


use Core\BaseRepository;

/**
 * Class FavoriteRepository
 * @package Repositories
 */
class FavoriteRepository implements BaseRepository{
    /**
     * @param $code
     */
    public function errors($code)
    {
        // TODO: Implement errors() method.
    }

    /**
     * @param array $related
     */
    public function all(array $related = null)
    {
        // TODO: Implement all() method.
    }

    /**
     * @param $id
     * @param array $related
     */
    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
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
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
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
    }

    /**
     * @param $column
     * @param $value
     */
    public function deleteWhere($column, $value)
    {
        // TODO: Implement deleteWhere() method.
    }

}