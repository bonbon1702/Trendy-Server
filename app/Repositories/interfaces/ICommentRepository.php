<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 27/03/2015
 * Time: 21:45
 */

namespace Repositories\interfaces;


/**
 * Interface ICommentRepository
 * @package Repositories\interfaces
 */
interface ICommentRepository
{
    /**
     * @param array $related
     * @return mixed
     */
    public function all(array $related = null);

    /**
     * @param $id
     * @param array $related
     * @return mixed
     */
    public function get($id, array $related = null);

    /**
     * @param $column
     * @param $value
     * @param array $related
     * @return mixed
     */
    public function getWhere($column, $value, array $related = null);

    /**
     * @param array $related
     */
    public function getRecent(array $related = null);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param $column
     * @param $value
     * @param array $data
     * @return mixed
     */
    public function update($column, $value, array $data);

    /**
     * @param $id
     */
    public function delete($id);

    /**
     * @param $column
     * @param $value
     */
    public function deleteWhere($column, $value);

    /**
     * @param $typeComment
     * @param $typeId
     * @return mixed
     */
    public function whereTypeComment($typeComment, $typeId);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteCommentInPost($id);
}