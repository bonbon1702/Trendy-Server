<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 11/3/2014
 * Time: 9:46 AM
 */

namespace Repositories;

use Core\BaseRepository;
use Illuminate\Support\Facades\Auth;

use \User;

/**
 * Class UserRepository
 * @package Repositories
 */
class UserRepository implements BaseRepository
{
    /**
     * @param $code
     */
    public function errors($code)
    {
        // TODO: Implement errors() method.
    }

    /**
     * @param array $related
     * @return mixed
     */
    public function all(array $related = null)
    {
        // TODO: Implement all() method.
        $users = User::all();

        return $users;
    }

    /**
     * @param $id
     * @param array $related
     * @return null
     */
    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $user = null;

        if (!empty($id)) {
            $user = User::find($id);
        }

        return $user;
    }

    /**
     * @param $column
     * @param $value
     * @param array $related
     * @return mixed
     */
    public function getWhere($column, $value, array $related = null)
    {
        $user = User::where($column, $value);
        return $user;
    }

    /**
     * @param array $related
     * @return User
     */
    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
        $user = new User();
        return $user;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        return User::create($data);
    }

    /**
     * @param $column
     * @param $value
     * @param array $data
     * @return mixed
     */
    public function update($column, $value, array $data)
    {
        // TODO: Implement update() method.
        if (!empty($data)){
            $user = $this->getWhere($column,$value)
                ->update($data);
        }
        return $user;
    }


    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
        return $this->get($id)->delete();
    }

    /**
     * @param $column
     * @param $value
     */
    public function deleteWhere($column, $value)
    {
        // TODO: Implement deleteWhere() method.
        $this->getWhere($column, $value)->delete();

    }
}