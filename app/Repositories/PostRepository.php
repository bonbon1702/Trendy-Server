<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:24 AM
 */

namespace Repositories;


use Illuminate\Support\Facades\Auth;
use \Post;
use Repositories\interfaces\IPostRepository;

/**
 * Class PostRepository
 * @package Repositories
 */
class PostRepository implements IPostRepository{
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
        $posts = Post::all();
        return $posts;
    }

    /**
     * @param $id
     * @param array $related
     * @return mixed
     */
    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $post = Post::find($id);

        return $post;
    }

    /**
     * @param $column
     * @param $value
     * @param array $related
     * @return mixed
     */
    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
        $post = Post::where($column,$value);

        return $post;
    }

    /**
     * @param array $related
     * @return Post
     */
    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
        $post = new Post();
        return $post;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)){
            $post = Post::create($data);
        }

        return $post;
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
            $post = $this->getWhere($column,$value)
                            ->update($data);
        }
        return $post;
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
        $this->get($id)->delete();
    }

    /**
     * @param $column
     * @param $value
     */
    public function deleteWhere($column, $value)
    {
        // TODO: Implement deleteWhere() method.
        $this->getWhere($column,$value)->delete();
    }

}