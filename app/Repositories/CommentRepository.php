<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:19 AM
 */

namespace Repositories;


use Core\BaseRepository;
use \Comment;
use Repositories\interfaces\ICommentRepository;

/**
 * Class CommentRepository
 * @package Repositories
 */
class CommentRepository implements ICommentRepository{

    /**
     * @param array $related
     * @return mixed
     */
    public function all(array $related = null)
    {
        // TODO: Implement all() method.
        $comment = Comment::all();
        return $comment;
    }

    /**
     * @param $id
     * @param array $related
     * @return mixed
     */
    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $comment = Comment::find($id);
        return $comment;
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
        $comment = Comment::where($column,$value);
        return $comment;
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
            $comment = Comment::create($data);
        }
        return $comment;
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
            $comment = $this->getWhere($column,$value)
                ->update($data);
        }
        return $comment;
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

    /**
     * @param $typeComment
     * @param $typeId
     * @return mixed
     */
    public function whereTypeComment($typeComment, $typeId){
        return Comment::where('type_comment', $typeComment)->where('type_id', $typeId)->get();
    }

    public  function deleteCommentInPost($typeId){
        return Comment::where('type_comment', 0)->where('type_id', $typeId)->delete();
    }

}