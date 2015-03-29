<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 27/03/2015
 * Time: 21:37
 */

namespace Services\interfaces;


/**
 * Interface IShopService
 * @package Services\interfaces
 */
interface IShopService
{

    /**
     * @param $id
     * @return mixed
     */
    public function getShopByShopId($id);


    /**
     * @param $result
     * @return mixed
     */
    public function checkCoordinates($result);

    /**
     * @param $type
     * @return mixed
     */
    public function searchShop($type);

    /**
     * @param $address
     * @return mixed
     */
    public function checkExist($address);

    /**
     * @param $type
     * @return mixed
     */
    public function searchFullText($type);

    /**
     * @param
     * @return mixed
     */
    public function getShopList();
}