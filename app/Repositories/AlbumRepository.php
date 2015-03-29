<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:19 AM
 */

namespace Repositories;


use Album;
use Repositories\interfaces\IAlbumRepository;

class AlbumRepository implements IAlbumRepository
{

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
        $album = Album::where($column, $value);

        return $album;
    }

    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
        $album = new Album();

        return $album;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)) {
            $album = Album::create($data);
        }

        return $album;
    }

    public function update($column, $value, array $data)
    {
        // TODO: Implement update() method.
        if (!empty($data)) {
            $album = $this->getWhere($column, $value)
                ->update($data);
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
        $this->getWhere($column, $value)->delete();
    }

    public function joinPostAndAlbumAndPostAlbum()
    {
        return Album::join('post_album', 'album.id', '=', 'post_album.album_id')
            ->join('post', 'post_album.post_id', '=', 'post.id');
    }


}