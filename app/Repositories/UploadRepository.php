<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/13/2015
 * Time: 10:25 PM
 */

namespace Repositories;


use Core\BaseRepository;
use Repositories\interfaces\IUploadRepository;
use \Upload;

/**
 * Class UploadRepository
 * @package Repositories
 */
class UploadRepository implements IUploadRepository{


    /**
     * @param array $related
     */
    public function all(array $related = null)
    {
        // TODO: Implement all() method.
    }

    /**
     * @param $id
     * @param array $related
     * @return mixed
     */
    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $upload = Upload::find($id);

        return $upload;
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
        $upload = Upload::where($column,$value)->first();

        return $upload;
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
            $upload = Upload::create($data);
        }

        return $upload;
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
        $this->getWhere($column, $value)
                            ->update($data);
        $upload = $this->getWhere($column,$value);
        return $upload;
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param $column
     * @param $value
     */
    public function deleteWhere($column, $value)
    {
        // TODO: Implement deleteWhere() method.
    }

}