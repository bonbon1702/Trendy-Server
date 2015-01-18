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

class RoleUserService implements BaseService
{
    private $roleUserRepository;

    function __construct(RoleUserRepository $roleUserRepository)
    {
        $this->roleUserRepository = $roleUserRepository;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        if ($this->roleUserRepository->create($data))
            return true;
    }

    public function update($model, array $data)
    {
        // TODO: Implement update() method.
        if ($this->roleUserRepository->update($data))
            return true;
    }

    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
        $this->roleUserRepository->deleteWhere($column,$value);
    }

}