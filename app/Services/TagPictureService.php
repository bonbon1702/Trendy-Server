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

class TagPictureService implements BaseService{

    private $tagPictureRepository;
    function __construct(TagPictureRepository $tagPictureRepository)
    {
        $this->tagPictureRepository = $tagPictureRepository;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        $tagPicture = $this->tagPictureRepository->create($data);

        return true;
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
