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

    /**
     * @param $user_id
     * @return mixed
     */
    public function banUser($user_id);

    /**
     * @param $user_id
     * @return mixed
     */
    public function unBanUser($user_id);

    /**
     * @return mixed
     */
    public function getAllShop();

    /**
     * @param $shop_detail_id
     * @return mixed
     */
    public function approveShop($shop_detail_id);

    /**
     * @param $shop_detail_id
     * @return mixed
     */
    public function unApproveShop($shop_detail_id);
}