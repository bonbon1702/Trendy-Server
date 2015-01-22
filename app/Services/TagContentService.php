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
use Repositories\UserRepository;

class TagContentService implements BaseService{

    private $tagContentRepository;

    private $userRepository;

    function __construct(TagContentRepository $tagContentRepository, UserRepository $userRepository)
    {
        // TODO: Implement __construct() method.
        $this->tagContentRepository = $tagContentRepository;
        $this->userRepository = $userRepository;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        $user_id = $this->userRepository->getRecent()->id;
        $content = $data['content'];
        $tagContent = $this->tagContentRepository->create(array(
            'user_id' => $user_id,
            'content' => $content,
        ));
        return true;
    }

    public function update(array $data)
    {
        // TODO: Implement update() method.
        $this->tagContentRepository->update('id', $data['id'], $data);
    }

    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
    }

    public function deleteTagContent($id)
    {
        $this->tagContentRepository->delete($id);
        return true;
    }


}