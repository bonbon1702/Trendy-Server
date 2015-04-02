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
     * @param $order_by
     * @param $id
     * @return mixed
     */
    public function getPostPaging($order_by, $id, $user_id);

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
}