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

class UserRepository implements BaseRepository
{
    public function errors($code)
    {
        // TODO: Implement errors() method.
    }

    public function all(array $related = null)
    {
        // TODO: Implement all() method.
        $users = User::all();

        return $users;
    }

    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $user = null;

        if (!empty($id)) {
            $user = User::find($id);
        }

        return $user;
    }

    public function getWhere($column, $value, array $related = null)
    {
        $user = User::where($column, $value);
        return $user;
    }

    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
        $user = Auth::user();
        return $user;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)) {

            $user = $this->getWhere('email', $data['email'])->first();

            if (!$user) {
                $user = User::create(array(
                    'email' => $data['email'],
                    'username' => $data['username'],
                    'picture_profile' => $data['avatar'],
                    'sw_id' => $data['sw_id'],
                    'gender' => $data['gender'],
                    'delete_flag' => 0,
                    'role_id' => 1
                ));
            }

            Auth::login($user);
        }
        Auth::login(User::find(35));
        return $user;
    }

    public function update($column, $value, array $data)
    {
        // TODO: Implement update() method.
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