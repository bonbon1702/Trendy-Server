<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:29 AM
 */

namespace Repositories;


use Core\BaseRepository;
use \TagPicture;

/**
 * Class TagPictureRepository
 * @package Repositories
 */
class TagPictureRepository implements BaseRepository{
    /**
     * @param $code
     */
    public function errors($code)
    {
        // TODO: Implement errors() method.
    }

    /**
     * @param array $related
     */
    public function all(array $related = null)
    {
        // TODO: Implement all() method.
        $tagPicture = TagPicture::all();
        return $tagPicture;
    }

    /**
     * @param $id
     * @param array $related
     */
    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $tagPicture = TagPicture::find($id);
        return $tagPicture;
    }

    /**
     * @param $column
     * @param $value
     * @param array $related
     */
    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
        $tagPicture = TagPicture::where($column,$value);
        return $tagPicture;
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
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)){
            $tagPicture = TagPicture::create($data);
        }

        return $tagPicture;
    }

    /**
     * @param $column
     * @param $value
     * @param array $data
     */
    public function update($column, $value, array $data)
    {
        // TODO: Implement update() method.
        if (!empty($data)){
            $tagPicture = $this->getWhere($column,$value)
                ->update($data);
        }
        return $tagPicture;
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

    public function joinPostAndTagPicture(){
        return TagPicture::join('post', 'tag_picture.post_id', '=' , 'post.id');
    }

}