<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:39 AM
 */

namespace Services;

use Repositories\TagContentRepository;
use Services\interfaces\ITagContentService;
use Repositories\interfaces\ITagContentRepository;

/**
 * Class TagContentService
 * @package Services
 */
class TagContentService implements ITagContentService{

    /**
     * @var TagContentRepository
     */
    private $tagContentRepository;

    function __construct(ITagContentRepository $tagContentRepository)
    {
        // TODO: Implement __construct() method.
        $this->tagContentRepository = $tagContentRepository;
    }

    public function getAllTag(){
        $tagContent = $this->tagContentRepository->all();

        return $tagContent;
    }
}