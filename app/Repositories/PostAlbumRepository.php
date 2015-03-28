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
use Repositories\interfaces\IPostAlbumRepository;

/**
 * Class PostAlbumRepository
 * @package Repositories
 */
class PostAlbumRepository implements IPostAlbumRepository
{

    /**
     *
     */
    function __construct()
    {
    }

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
     * @return PostAlbum
     */
    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
        $post_album = new PostAlbum();
        return $post_album;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)) {
            $post_album = PostAlbum::create($data);
        }

        return $post_album;
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