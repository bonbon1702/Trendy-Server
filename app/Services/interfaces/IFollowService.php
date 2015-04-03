<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 27/03/2015
 * Time: 21:33
 */

namespace Services\interfaces;


/**
 * Interface IFollowService
 * @package Services\interfaces
 */
interface IFollowService
{
    /**
     * @param array $data
     * @return mixed
     */
    public function addFollowing(array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function update(array $data);

    /**
     * @param $column
     * @param $value
     */
    public function delete($column, $value);

    /**
     * @param array $data
     * @return mixed
     */
    public function deleteFollowing(array $data);

    /**
     * @param $id
     * @return mixed
     */
    public function FollowingByUser($id);

    /**
     * @param $id
     * @return mixed
     */
    public function FollowerByUser($id);

    /**
     * @param $id
     * @param $user_id
     * @return array
     */
    public function itemToItemFollow($id, $user_id);

    /**
     * @param $user_id
     * @return array
     */
    public function popularFollow($user_id);
}