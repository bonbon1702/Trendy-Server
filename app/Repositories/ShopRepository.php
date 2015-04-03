<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:25 AM
 */

namespace Repositories;


use Repositories\interfaces\IShopRepository;
use Shop;

/**
 * Class ShopRepository
 * @package Repositories
 */
class ShopRepository implements IShopRepository
{

    /**
     * @param array $related
     */
    public function all(array $related = null)
    {
        // TODO: Implement all() method.
        $shop = Shop::all();
        return $shop;
    }

    /**
     * @param $id
     * @param array $related
     */
    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $shop = Shop::find($id);
        return $shop;
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
        $shop = Shop::where($column, $value)->first();

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
        if (!empty($data)) {
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
        if (!empty($data)) {
            $shop = $this->getWhere($column, $value)->update($data);
        }
        return $shop;
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
}