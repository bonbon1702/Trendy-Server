<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:28 AM
 */

namespace Repositories;


use Core\BaseRepository;

class TagLinkContentRepository implements BaseRepository{
    public function errors($code)
    {
        // TODO: Implement errors() method.
    }
    public function all(array $related = null)
    {
        // TODO: Implement all() method.
        $result = TagLinkContent::all();
        return $result;
    }

    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $result = TagLinkContent::find($id);

        return $result;
    }

    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
        $result = TagLinkContent::where($column, $value);

        return $result;
    }

    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)) {
            $result = TagLinkContent::create($data);
        }

        return $result;
    }

    public function update($column, $value, array $data)
    {
        // TODO: Implement update() method.
        if (!empty($data)) {
            $result = TagLinkContent::update($data);
        }
        return $result;
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