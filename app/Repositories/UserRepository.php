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
                $img = \Image::make($data['picture_profile']);

                $img->resize(50,50);

                $image_name = 'assets/images/' .strstr($data['email'], '@', true) . '_profile_picture.jpg';
                $img->save($image_name);
                $user = User::create(array(
                    'email' => $data['email'],
                    'username' => $data['username'],
                    'picture_profile' => $image_name,
                    'gender' => $data['gender'],
                    'delete_flag' => 0,
                    'role_id' => 1
                ));
            }

            Auth::login($user);
        }
        return true;
    }

    public function update($model, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function deleteWhere($column, $value)
    {
        // TODO: Implement deleteWhere() method.
    }
}