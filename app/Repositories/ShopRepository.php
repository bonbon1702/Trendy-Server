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

class ShopRepository implements BaseRepository{
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
    }

    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
        $shop = Shop::where($column,$value)->first();

        return $shop;
    }

    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)){
            $shop = Shop::create($data);
        }

        return $shop;
    }

    public function update($model, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function deleteWhere($column, $value)
    {
        // TODO: Implement deleteWhere() method.
    }

    public function search($type){
        $shop =  Shop::where('address', 'LIKE', '%'.$type.'%' )->get();

        return $shop;
    }
}