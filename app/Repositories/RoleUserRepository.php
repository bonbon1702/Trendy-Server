<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/7/2015
 * Time: 9:32 PM
 */

namespace Repositories;


use Core\BaseRepository;
use Repositories\interfaces\IRoleUserRepository;
use \RoleUser;

/**
 * Class RoleUserRepository
 * @package Repositories
 */
class RoleUserRepository implements IRoleUserRepository
{

    /**
     * @param array $related
     * @return mixed
     */
    public function all(array $related = null)
    {
        // TODO: Implement all() method.
        $role_user = RoleUser::all();

        return $role_user;
    }

    /**
     * @param $id
     * @param array $related
     * @return mixed
     */
    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $role_user = RoleUser::find($id);

        return $role_user;
    }

    /**
     * @param $column
     * @param $value
     * @param array $related
     */
    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
    }

    /**
     * @param array $related
     */
    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
    }

    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)) {
            $user_role = new RoleUser;
            $user_role->roll_name = $data['roll_name'];
            $user_role->save();
            return true;
        }
        return false;
    }

    /**
     * @param $column
     * @param $value
     * @param array $data
     * @return bool
     */
    public function update($column, $value, array $data)
    {
        // TODO: Implement update() method.
        if (!empty($data)) {
            RoleUser::where('id', $data['id'])
                ->update(array(
                    'role_name' => $data['role_name']
                ));
            return true;
        }
        return false;
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
        RoleUser::where('id', $id)->delete();
    }

    /**
     * @param $column
     * @param $value
     */
    public function deleteWhere($column, $value)
    {
        // TODO: Implement deleteWhere() method.
        if (!empty($column) && !empty($value)) {
            RoleUser::where($column, $value)->delete();
        }
    }

}