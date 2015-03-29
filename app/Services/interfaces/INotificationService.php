<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 27/03/2015
 * Time: 21:35
 */

namespace Services\interfaces;


/**
 * Interface INotificationService
 * @package Services\interfaces
 */
interface INotificationService
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);


    /**
     * @param $user_id
     * @return array
     */
    public function getNotification($user_id);

    /**
     * @param $post_id
     * @return mixed
     */
    public function userEffectedPost($post_id);
}