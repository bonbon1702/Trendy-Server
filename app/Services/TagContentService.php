<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:39 AM
 */

namespace Services;


use Core\BaseService;
use Repositories\TagContentRepository;

class TagContentService implements BaseService{

    private $tagContentRepository;

    function __construct(TagContentRepository $tagContentRepository)
    {
        // TODO: Implement __construct() method.
        $this->tagContentRepository = $tagContentRepository;
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