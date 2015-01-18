<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/13/2015
 * Time: 10:25 PM
 */

namespace Repositories;


use Core\BaseRepository;
use \Upload;

class UploadRepository implements BaseRepository{
    public function errors($code)
    {
        // TODO: Implement errors() method.
    }

    public function all(array $related = null)
    {
        // TODO: Implement all() method.
    }

    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $upload = Upload::find($id);

        return $upload;
    }

    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
        $upload = Upload::where($column,$value)->first();

        return $upload;
    }

    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)){
            $upload = Upload::create($data);
        }

        return $upload;
    }

    public function update($model, array $data)
    {
        // TODO: Implement update() method.
        if (!empty($data)){
            $upload = $model->update($data);
        }
        return $upload;
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