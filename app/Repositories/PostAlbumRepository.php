<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 2/9/15
 * Time: 4:33 PM
 */

namespace Repositories;


use Core\BaseRepository;
use \PostAlbum;

class PostAlbumRepository implements BaseRepository{

    function __construct()
    {
    }

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
    }

    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)){
            $post_album = PostAlbum::create($data);
        }

        return $post_album;
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