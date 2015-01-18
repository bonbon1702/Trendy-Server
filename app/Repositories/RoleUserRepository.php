<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/7/2015
 * Time: 9:32 PM
 */

namespace Repositories;


use Core\BaseRepository;
use \RoleUser;

class RoleUserRepository implements BaseRepository
{

    public function errors($code)
    {
        // TODO: Implement errors() method.
    }

    public function all(array $related = null)
    {
        // TODO: Implement all() method.
        $role_user = RoleUser::all();

        return $role_user;
    }

    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $role_user = RoleUser::find($id);

        return $role_user;
    }

    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
    }

    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
    }

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

    public function update($model, array $data)
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

    public function delete($id)
    {
        // TODO: Implement delete() method.
        RoleUser::where('id', $id)->delete();
    }

    public function deleteWhere($column, $value)
    {
        // TODO: Implement deleteWhere() method.
        if (!empty($column) && !empty($value)) {
            RoleUser::where($column, $value)->delete();
        }
    }

}