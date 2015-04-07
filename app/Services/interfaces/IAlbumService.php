<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 27/03/2015
 * Time: 21:31
 */

namespace Services\interfaces;


/**
 * Interface IAlbumService
 * @package Services\interfaces
 */
interface IAlbumService
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     * @return bool
     */
    public function editAlbumById(array $data);

    /**
     * @param $column
     * @param $value
     */
    public function delete($column, $value);

    /**
     * @param $id
     * @return mixed
     */
    public function getListAlbumOfUser($id);

    /**
     * @param $album_name
     * @param $user_id
     * @return mixed
     */
    public function getAlbumDetail($album_name, $user_id);

    /**
     * @param $userId
     * @return mixed
     */
    public function getAlbum($userId);

    /**
     * @param $album_name
     */
    public function deleteAlbum($album_name);
}