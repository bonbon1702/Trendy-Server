<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 27/03/2015
 * Time: 21:32
 */

namespace Services\interfaces;


/**
 * Interface ICommentService
 * @package Services\interfaces
 */
interface ICommentService
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     */
    public function update(array $data);


    /**
     * @param $id
     * @return mixed
     */
    public function showCommentByPostId($id);

    /**
     * @param $id
     * @return mixed
     */
    public function showCommentByShopId($id);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteCommentInPost($id);

    /**
     * @param $id
     * @param $content
     * @return mixed
     */
    public function editPostComment($id, $content);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteCommentInShop($id);

    /**
     * @param $id
     * @param $content
     * @return mixed
     */
    public function editShopComment($id, $content);
}