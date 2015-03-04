<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:25 AM
 */

namespace Repositories;


use Core\BaseRepository;
use \Shop;

/**
 * Class ShopRepository
 * @package Repositories
 */
class ShopRepository implements BaseRepository{
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
     * @return mixed
     */
    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
        $shop = Shop::where($column,$value)->first();

        return $shop;
    }

    /**
     * @param array $related
     * @return Shop
     */
    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
        $shop = new Shop();

        return $shop;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)){
            $shop = Shop::create($data);
        }

        return $shop;
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