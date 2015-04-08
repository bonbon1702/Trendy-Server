<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 05/04/2015
 * Time: 16:15
 */

namespace Services;


use Repositories\interfaces\IAdminRepository;
use Repositories\interfaces\IShopDetailRepository;
use Repositories\interfaces\IShopRepository;
use Repositories\interfaces\IUserRepository;
use Services\interfaces\IAdminService;

class AdminService implements IAdminService{

    private $adminRepository;

    private $userRepository;

    private $shopRepository;

    private $shopDetailRepository;

    function __construct(IAdminRepository $adminRepository, IUserRepository $userRepository, IShopRepository $shopRepository, IShopDetailRepository $shopDetailRepository)
    {
        $this->adminRepository = $adminRepository;
        $this->userRepository = $userRepository;
        $this->shopRepository = $shopRepository;
        $this->shopDetailRepository = $shopDetailRepository;
    }

    public function adminLogin($data){
        $result = $this->adminRepository->getRecent()
            ->where('username', $data['username'])
            ->where('password', $data['password'])
            ->first();
        return $result;
    }

    /**
     * @return mixed
     */
    public function getAllUser()
    {
        $users = $this->userRepository->all();

        return $users;
    }

    public function banUser($user_id)
    {
        // TODO: Implement banUser() method.
        $this->userRepository->update('id', $user_id,array(
            'delete_flag' => 1
        ));

        return true;
    }

    public function unBanUser($user_id)
    {
        // TODO: Implement unBanUser() method.
        $this->userRepository->update('id', $user_id,array(
            'delete_flag' => 0
        ));

        return true;
    }

    public function getAllShop(){
        $shops = $this->shopRepository->getRecent()
                    ->select('shop_detail.*')
                    ->join('shop_detail', 'shop_detail.shop_id', '=', 'shop.id')
                    ->get();

        return $shops;
    }

    public function approveShop($shop_detail_id)
    {
        $this->shopDetailRepository->update('id',$shop_detail_id, array(
            'approve' => 1
        ));
        return true;
    }

    public function unApproveShop($shop_detail_id)
    {
        $this->shopDetailRepository->update('id',$shop_detail_id, array(
            'approve' => 0
        ));
        return true;
    }


}