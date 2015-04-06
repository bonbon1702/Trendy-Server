<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 05/04/2015
 * Time: 16:15
 */

namespace Services;


use Repositories\interfaces\IAdminRepository;
use Repositories\interfaces\IUserRepository;
use Services\interfaces\IAdminService;

class AdminService implements IAdminService{

    private $adminRepository;

    private $userRepository;

    function __construct(IAdminRepository $adminRepository, IUserRepository $userRepository)
    {
        $this->adminRepository = $adminRepository;
        $this->userRepository = $userRepository;
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


}