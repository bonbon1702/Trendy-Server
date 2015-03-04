<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:42 AM
 */

namespace Services;


use Core\BaseService;
use Repositories\TagPictureRepository;

/**
 * Class TagPictureService
 * @package Services
 */
class TagPictureService implements BaseService{

    /**
     * @var TagPictureRepository
     */
    private $tagPictureRepository;

    /**
     * @param TagPictureRepository $tagPictureRepository
     */
    function __construct(TagPictureRepository $tagPictureRepository)
    {
        $this->tagPictureRepository = $tagPictureRepository;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        $tagPicture = $this->tagPictureRepository->create($data);

        return true;
    }

    /**
     * @param array $data
     */
    public function update(array $data)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $column
     * @param $value
     */
    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
    }
}
