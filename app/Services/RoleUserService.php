<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 9:59 AM
 */

namespace Services;

use Repositories\interfaces\IRoleUserRepository;
use Services\interfaces\IRoleUserService;

/**
 * Class RoleUserService
 * @package Services
 */
class RoleUserService implements IRoleUserService
{
    /**
     * @var RoleUserRepository
     */
    private $roleUserRepository;


    /**
     * @param IRoleUserRepository $roleUserRepository
     */
    function __construct(IRoleUserRepository $roleUserRepository)
    {
        $this->roleUserRepository = $roleUserRepository;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        if ($this->roleUserRepository->create($data))
            return true;
    }

    /**
     * @param $column
     * @param $value
     */
    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
        $this->roleUserRepository->deleteWhere($column,$value);
    }

}