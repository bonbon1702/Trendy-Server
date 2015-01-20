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

    private $userRepository;

    function __construct(CommentRepository $commentRepository, UserRepository $userRepository)
    {
        // TODO: Implement __construct() method.
        $this->commentRepository = $commentRepository;
        $this->userRepository = $userRepository;
    }
    public function create(array $data)
    {
        // TODO: Implement create() method.
        $content = $data['content'];
        $user_id = $this->userRepository->getRecent()->id;
        $this->commentRepository->create(array(
            'user_id' => $user_id,
            'content' => $content,
        ));
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