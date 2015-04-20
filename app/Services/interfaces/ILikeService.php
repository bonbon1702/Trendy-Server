<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 27/03/2015
 * Time: 21:34
 */

namespace Services\interfaces;


/**
 * Interface ILikeService
 * @package Services\interfaces
 */
/**
 * Interface ILikeService
 * @package Services\interfaces
 */
interface ILikeService
{

    /**
     * @param $type_like
     * @param $type_id
     * @param $type
     * @param $user_id
     * @return bool
     */
    public function likeOrDislike($type_like, $type_id, $type, $user_id);

    /**
     * @param $type_like
     * @param $type_id
     * @return mixed
     */
    public function countLike($type_like, $type_id);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteLikeInPost($id);
}