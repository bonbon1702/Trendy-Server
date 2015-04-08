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

    public function banUser($user_id);

    public function unBanUser($user_id);

    public function getAllShop();

    public function approveShop($shop_detail_id);

    public function unApproveShop($shop_detail_id);
}