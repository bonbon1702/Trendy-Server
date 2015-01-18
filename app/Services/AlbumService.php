<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:29 AM
 */

namespace Services;


use Core\BaseService;
use Repositories\AlbumRepository;

class AlbumService implements BaseService{

    private $albumRepository;
    function __construct(AlbumRepository $albumRepository)
    {
        // TODO: Implement __construct() method.
        $this->albumRepository = $albumRepository;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function update($model, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
    }

}