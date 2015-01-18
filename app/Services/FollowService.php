<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:32 AM
 */

namespace Services;


use Core\BaseService;
use Repositories\FollowRepository;

class FollowService implements BaseService{

    private $followRepository;

    function __construct(FollowRepository $followRepository)
    {
        // TODO: Implement __construct() method.
        $this->followRepository = $followRepository;
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