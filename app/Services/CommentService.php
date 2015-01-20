<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:31 AM
 */

namespace Services;


use Core\BaseService;
use Repositories\CommentRepository;

class CommentService implements BaseService{

    private $commentRepository;
    function __construct(CommentRepository $commentRepository)
    {
        // TODO: Implement __construct() method.
        $this->commentRepository = $commentRepository;
    }
    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function update(array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
    }
}