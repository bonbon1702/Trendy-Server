<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 11/3/2014
 * Time: 10:00 AM
 */

namespace Services;

use Core\BaseService;
use Repositories\UserRepository;

class UserService implements BaseService
{

    private $userRepository;

    function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function create(array $data)
    {
        // TODO: Implement create() method.
        if ($this->userRepository->create($data)) return true;
    }

    public function update(array $data)
    {
        // TODO: Implement update() method.
    }


    public function delete($column, $value)
    {
        // TODO: Implement deleteWhere() method.
    }

}