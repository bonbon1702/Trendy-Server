<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 27/03/2015
 * Time: 21:12
 */

namespace Services\interfaces;

/**
 * Interface IPostService
 * @package Services\interfaces
 */
/**
 * Interface IPostService
 * @package Services\interfaces
 */
interface IPostService
{
    /**
     * @param array $data
     */
    public function createPost(array $data);

    /**
     * @param array $data
     */
    public function update(array $data);

    /**
     * @param $column
     * @param $value
     */
    public function delete($column, $value);

    /**
     * @return mixed
     */
    public function allPost();

    /**
     * @param $id
     * @return mixed
     */
    public function getPostDetails($id);

    /**
     * @param $id
     */
    public function deletePost($id);

    /**
     * @param $id
     * @param $caption
     * @return mixed
     */
    public function editPostCaption($id, $caption);

    /**
     * @param $id
     * @param $tag
     * @return mixed
     */
    public function getPostTrendy($id, $tag);

    /**
     * @param $id
     * @param $lat
     * @param $long
     * @return mixed
     */
    public function getPostAround($id, $lat, $long);

    /**
     * @param $id
     * @param $user_id
     * @return mixed
     */
    public function getPostFavorite($id, $user_id);

    /**
     * @param $id
     * @param $user_id
     * @return mixed
     */
    public function getPostNewFeed($id, $user_id);
}