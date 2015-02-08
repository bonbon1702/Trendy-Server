<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 11/4/2014
 * Time: 7:54 PM
 */
namespace Core;

interface BaseService{

    public function create(array $data);

    public function update(array $data);

    public function delete($column, $value);

}