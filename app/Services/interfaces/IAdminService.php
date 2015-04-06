<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 05/04/2015
 * Time: 16:14
 */

namespace Services\interfaces;

/**
 * Interface IAdminService
 * @package Services\interfaces
 */
interface IAdminService {

    /**
     * @param $data
     * @return mixed
     */
    public function adminLogin($data);

    /**
     * @return mixed
     */
    public function getAllUser();
}