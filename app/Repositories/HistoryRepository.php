<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 2/8/15
 * Time: 2:21 PM
 */

namespace Repositories;


use Core\BaseRepository;
use \History;

class HistoryRepository implements BaseRepository{

    public function errors($code)
    {
        // TODO: Implement errors() method.
    }

    public function all(array $related = null)
    {
        // TODO: Implement all() method.
        $history = History::all();
        return $history;
    }

    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $history = History::find($id);

        return $history;
    }

    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
        $history = History::where($column, $value);

        return $history;
    }

    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
        $history = new History();
        return $history;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)) {
            $history = History::create($data);
        }

        return $history;
    }

    public function update($column, $value, array $data)
    {
        // TODO: Implement update() method.
        if (!empty($data)) {
            $history = $this->getWhere($column,$value)
                                ->update($data);
        }
        return $history;
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