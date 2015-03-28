<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/26/2015
 * Time: 7:31 PM
 */

namespace Repositories;

use Core\BaseRepository;
use \Favorite;
use Repositories\interfaces\IFavoriteRepository;

/**
 * Class FavoriteRepository
 * @package Repositories
 */
class FavoriteRepository implements IFavoriteRepository{

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
        $favorite = Favorite::where($column, $value);

        return $favorite;
    }

    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
        $favorite = new Favorite();

        return $favorite;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)) {
             $favorite = Favorite::create($data);
        };
        return $favorite;
    }

    public function update($column, $value, array $data)
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

}