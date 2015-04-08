<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 05/04/2015
 * Time: 16:16
 */

namespace Repositories;


use Repositories\interfaces\IAdminRepository;
use \Admin;

class AdminRepository implements IAdminRepository{

    public function all(array $related = null)
    {
        // TODO: Implement all() method.
        $admin = Admin::all();
        return $admin;
    }

    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $admin = Admin::find($id);

        return $admin;
    }

    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
        $admin = Admin::where($column, $value);

        return $admin;
    }

    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
        $admin = new Admin();

        return $admin;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)) {
            $admin = Admin::create($data);
        }

        return $admin;
    }

    public function update($column, $value, array $data)
    {
        // TODO: Implement update() method.
        if (!empty($data)) {
            $admin = $this->getWhere($column, $value)
                ->update($data);
        }
        return $admin;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        $this->get($id)->delete();
    }

    public function deleteWhere($column, $value)
    {
        // TODO: Implement deleteWhere() method.
        $this->getWhere($column, $value)->delete();
    }

}