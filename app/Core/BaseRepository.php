<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 11/3/2014
 * Time: 9:39 AM
 */

namespace Core;

interface BaseRepository{
    public function errors($code);

    public function all(array $related = null);

    public function get($id, array $related = null);

    public function getWhere($column, $value, array $related = null);

    public function getRecent(array $related = null);

    public function create(array $data);

    public function update($model, array $data);

    public function delete($id);

    public function deleteWhere($column, $value);
}