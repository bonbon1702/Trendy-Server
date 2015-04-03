<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 27/03/2015
 * Time: 21:38
 */

namespace Services\interfaces;


/**
 * Interface IUserService
 * @package Services\interfaces
 */
interface IUserService
{

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);


    /**
     * @param array $data
     * @return mixed
     */
    public function changeCover(array $data);


    /**
     * @param $column
     * @param $value
     */
    public function deleteLogoutUser($column, $value);

    /**
     * @param $id
     * @return null
     */
    public function getUserInfo($id);

    /**
     * @param $type
     * @return mixed
     */
    public function searchFullText($type);

    /**
     * @return mixed
     */
    public function getAllUser();
}