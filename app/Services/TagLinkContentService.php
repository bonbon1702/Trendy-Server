<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:40 AM
 */

namespace Services;


use Core\BaseService;
use Repositories\TagLinkContentRepository;

class TagLinkContentService implements BaseService{

    private $tagLinkContentRepository;
    function __construct(TagLinkContentRepository $tagLinkContentRepository)
    {
        // TODO: Implement __construct() method.
        $this->tagLinkContentRepository = $tagLinkContentRepository;
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