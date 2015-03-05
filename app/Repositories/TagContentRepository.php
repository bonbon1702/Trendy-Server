<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:27 AM
 */

namespace Repositories;


use Core\BaseRepository;
use \TagContent;

/**
 * Class TagContentRepository
 * @package Repositories
 */
class TagContentRepository implements BaseRepository{
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
        $tagContent = TagContent::all();
        return $tagContent;
    }

    /**
     * @param $id
     * @param array $related
     * @return mixed
     */
    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $tagContent = TagContent::find($id);
        return $tagContent;
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
        $tagContent = TagContent::where($column,$value);
        return $tagContent;
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
            $tagContent = TagContent::create($data);
        }
        return $tagContent;
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
            $tagContent = $this->getWhere($column,$value)
                ->update($data);
        }
        return $tagContent;
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
     * @param $type
     * @return mixed
     */
    public function search($type){
        $tagContent =  TagContent::where('content', 'LIKE', '%'.$type.'%' )->get();
        // $shop = Shop::whereRaw('MATCH(name,address) AGAINST (?)', array(
        //         $type
        //     ));
        return $tagContent;
    }
}