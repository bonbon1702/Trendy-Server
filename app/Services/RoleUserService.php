<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 9:59 AM
 */

namespace Services;


use Core\BaseService;
use Repositories\RoleUserRepository;

/**
 * Class RoleUserService
 * @package Services
 */
class RoleUserService implements BaseService
{
    /**
     * @var RoleUserRepository
     */
    private $roleUserRepository;

    /**
     * @param RoleUserRepository $roleUserRepository
     */
    function __construct(RoleUserRepository $roleUserRepository)
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
     * @param array $data
     */
    public function update(array $data)
    {
        // TODO: Implement update() method.
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