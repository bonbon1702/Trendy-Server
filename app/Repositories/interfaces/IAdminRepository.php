<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 05/04/2015
 * Time: 16:15
 */

namespace Repositories\interfaces;

/**
 * Interface IAdminRepository
 * @package Repositories\interfaces
 */
interface IAdminRepository {
    /**
     * @param array $related
     * @return mixed
     */
    public function all(array $related = null);

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
     * @return mixed
     */
    public function getWhere($column, $value, array $related = null);

    /**
     * @param array $related
     * @return mixed
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
     * @return mixed
     */
    public function update($column, $value, array $data);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param $column
     * @param $value
     * @return mixed
     */
    public function deleteWhere($column, $value);
}