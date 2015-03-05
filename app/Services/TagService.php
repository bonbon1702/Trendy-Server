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

/**
 * Class TagService
 * @package Services
 */
class TagService implements BaseService
{

    /**
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * @param TagRepository $tagRepository
     */
    function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        $postId = $data['post_id'];
        $tagContentId = $data['tag_content_id'];
        return $this->tagRepository->create(array(
            'post_id' => $postId,
            'tag_content_id' => $tagContentId
        ));
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function update(array $data)
    {
        // TODO: Implement update() method.
        return $this->tagRepository->update('post_id', $data['post_id'], $data);
    }

    /**
     * @param $column
     * @param $value
     * @return mixed
     */
    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
        return $this->tagRepository->deleteWhere('post_id',$value);
    }

    /**
     * @return mixed
     */
    public function listAllTag()
    {
        $tag = $this->tagRepository->all();
        return $tag;
    }
}