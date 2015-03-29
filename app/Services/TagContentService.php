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
use Services\interfaces\ITagContentService;
use Repositories\interfaces\ITagContentRepository;
use Repositories\interfaces\IUserRepository;

/**
 * Class TagContentService
 * @package Services
 */
class TagContentService implements ITagContentService{

    /**
     * @var TagContentRepository
     */
    private $tagContentRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;


    function __construct(ITagContentRepository $tagContentRepository, IUserRepository $userRepository)
    {
        // TODO: Implement __construct() method.
        $this->tagContentRepository = $tagContentRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {

    }

    /**
     * @param array $data
     */
    public function update(array $data)
    {
        // TODO: Implement update() method.
        $this->tagContentRepository->update('id', $data['id'], $data);
    }

    /**
     * @param $column
     * @param $value
     */
    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteTagContent($id)
    {
        $this->tagContentRepository->delete($id);
        return true;
    }

    /**
     * @param $type
     * @return mixed
     */
    public function searchTag($type){
        $tag = $this->tagContentRepository->search($type);

        return $tag;
    }

}