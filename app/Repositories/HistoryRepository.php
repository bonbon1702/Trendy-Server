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
use Repositories\interfaces\IHistoryRepository;

/**
 * Class HistoryRepository
 * @package Repositories
 */
class HistoryRepository implements IHistoryRepository{

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
        $history = History::all();
        return $history;
    }

    /**
     * @param $id
     * @param array $related
     * @return mixed
     */
    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $history = History::find($id);

        return $history;
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
        $history = History::where($column, $value);

        return $history;
    }

    /**
     * @param array $related
     * @return History
     */
    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
        $history = new History();
        return $history;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)) {
            $history = History::create($data);
        }

        return $history;
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
        if (!empty($data)) {
            $history = $this->getWhere($column,$value)
                                ->update($data);
        }
        return $history;
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
        $this->getWhere($column, $value)->delete();
    }

} 