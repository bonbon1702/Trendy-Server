<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 27/03/2015
 * Time: 21:36
 */

namespace Services\interfaces;


/**
 * Interface IShopDetailService
 * @package Services\interfaces
 */
interface IShopDetailService
{

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param $id
     * @return mixed
     */
    public function getShopDetail($id);
}