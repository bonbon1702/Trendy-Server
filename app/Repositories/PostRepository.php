<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:24 AM
 */

namespace Repositories;


use Core\BaseRepository;
use Illuminate\Support\Facades\Auth;
use \Post;

class PostRepository implements BaseRepository{
    public function errors($code)
    {
        // TODO: Implement errors() method.
    }

    public function all(array $related = null)
    {
        // TODO: Implement all() method.
        $posts = Post::all();
        return $posts;
    }

    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $post = Post::find($id);

        return $post;
    }

    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
        $post = Post::where($column,$value);

        return $post;
    }

    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)){
            $post = Post::create($data);
        }

        return $post;
    }

    public function update($model, array $data)
    {
        // TODO: Implement update() method.
        if (!empty($data)){
            $post = Post::update($data);
        }
        return $post;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function deleteWhere($column, $value)
    {
        // TODO: Implement deleteWhere() method.
        $this->getWhere($column,$value)->delete();
    }

}