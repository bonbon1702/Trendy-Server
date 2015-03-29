<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 27/03/2015
 * Time: 21:36
 */

namespace Services\interfaces;


/**
 * Interface IRoleUserService
 * @package Services\interfaces
 */
interface IRoleUserService
{
    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data);

    /**
     * @param $column
     * @param $value
     */
    public function delete($column, $value);
}