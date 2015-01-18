<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:38 AM
 */

namespace Services;


use Core\BaseService;
use Repositories\TagRepository;

class TagService implements BaseService{

    private $tagRepository;
    function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
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