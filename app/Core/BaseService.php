<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 11/4/2014
 * Time: 7:54 PM
 */
namespace Core;

/**
 * Interface BaseService
 * @package Core
 */
interface BaseService{

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function update(array $data);

    /**
     * @param $column
     * @param $value
     * @return mixed
     */
    public function delete($column, $value);

}