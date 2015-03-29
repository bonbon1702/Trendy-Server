<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 13/3/2015
 * Time: 4:57 PM
 */
namespace Repositories;


use Core\BaseRepository;
use Repositories\interfaces\IShopDetailRepository;
use \ShopDetail;

/**
 * Class ShopRepository
 * @package Repositories
 */
class ShopDetailRepository implements IShopDetailRepository{

    /**
     * @param array $related
     */
    public function all(array $related = null)
    {
        // TODO: Implement all() method.
        $shopDetail = ShopDetail::all();
        return $shopDetail;
    }

    /**
     * @param $id
     * @param array $related
     */
    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $shopDetail = ShopDetail::find($id);
        return $shopDetail;
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
        $shopDetail = ShopDetail::where($column,$value)->first();

        return $shopDetail;
    }

    /**
     * @param array $related
     * @return Shop
     */
    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
        $shopDetail = new ShopDetail();

        return $shopDetail;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)){
            $shopDetail = ShopDetail::create($data);
        }

        return $shopDetail;
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
            $shopDetail = $this->getWhere($column, $value)->update($data);
        }
        return $shopDetail;
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