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

/**
 * Class AlbumRepository
 * @package Repositories
 */
class AlbumRepository implements BaseRepository
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
        $album = Album::all();
        return $album;
    }

    /**
     * @param $id
     * @param array $related
     * @return mixed
     */
    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $album = Album::find($id);

        return $album;
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
        $album = Album::where($column, $value);

        return $album;
    }

    /**
     * @param array $related
     * @return Album
     */
    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
        $album = new Album();
        
        return $album;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)) {
            $album = Album::create($data);
        }

        return $album;
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
        if (!empty($data)) {
            $album = $this->getWhere($column,$value)
                ->update($data);
        }
        return $album;
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

    /**
     * @return mixed
     */
    public function joinPostAndAlbumAndPostAlbum(){
        return Album::join('post_album', 'album.id', '=' , 'post_album.album_id')
                        ->join('post','post_album.post_id','=','post.id');
    }



}