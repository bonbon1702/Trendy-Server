<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 27/03/2015
 * Time: 21:47
 */

namespace Repositories\interfaces;


/**
 * Interface ILikeRepository
 * @package Repositories\interfaces
 */
interface ILikeRepository
{

    /**
     * @param $id
     * @param array $related
     * @return mixed
     */
    public function get($id, array $related = null);

    /**
     * @param $column
     * @param $value
     * @param array $related
     */
    public function getWhere($column, $value, array $related = null);

    /**
     * @param array $related
     */
    public function getRecent(array $related = null);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param $column
     * @param $value
     * @param array $data
     */
    public function update($column, $value, array $data);

    /**
     * @param $id
     */
    public function delete($id);

    /**
     * @param $column
     * @param $value
     */
    public function deleteWhere($column, $value);

    /**
     * @param $user_id
     * @param $type_like
     * @param $type_id
     * @return mixed
     */
    public function getUserLike($user_id, $type_like, $type_id);

    /**
     * @param $type_like
     * @param $type_id
     * @return mixed
     */
    public function getLike($type_like, $type_id);
}