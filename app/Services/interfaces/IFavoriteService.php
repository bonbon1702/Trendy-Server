<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 27/03/2015
 * Time: 21:32
 */

namespace Services\interfaces;


/**
 * Interface IFavoriteService
 * @package Services\interfaces
 */
interface IFavoriteService
{
    /**
     * @param array $data
     * @return mixed
     */
    public function addFavorite(array $data);

    /**
     * @param $user_id
     * @param $post_id
     */
    public function unFavorite($user_id, $post_id);

    /**
     * @param $post_id
     * @return mixed
     */
    public function getUserFavorite($post_id);
}