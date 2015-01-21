<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:19 AM
 */

namespace Repositories;


use Core\BaseRepository;
use \Album;

class AlbumRepository implements BaseRepository{
    public function errors($code)
    {
        // TODO: Implement errors() method.
    }

    public function all(array $related = null)
    {
        // TODO: Implement all() method.
        $album = Album::all();
        return $album;
    }

    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $album = Album::find($id);

        return $album;
    }

    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
        $album = Album::where($column,$value);

        return $album;
    }

    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)){
            $album = Album::create($data);
        }

        return $album;
    }

    public function update($column, $value, array $data)
    {
        // TODO: Implement update() method.
        if (!empty($data)){
            $album = Album::update($data);
        }
        return $album;
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