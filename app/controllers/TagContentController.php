<?php
/**
 * Created by PhpStorm.
 * User: Anh
 * Date: 1/22/2015
 * Time: 3:38 PM
 */

use Repositories\TagContentRepository;
use Services\TagContentService;

/**
 * Class TagContentController
 */
class TagContentController extends \BaseController {

    /**
     * @var TagContentRepository
     */
    private $tagContentRepository;

    /**
     * @var TagContentService
     */
    private $tagContentService;

    /**
     * @param TagContentService $tagContentService
     * @param TagContentRepository $tagContentRepository
     */
    public function __construct(TagContentService $tagContentService, TagContentRepository $tagContentRepository) {
        $this->tagContentRepository = $tagContentRepository;
        $this->tagContentService = $tagContentService;
    }

    /**
     * @return mixed
     */
    public function getAllTag() {
        $tagContent = $this->tagContentService->getAllTag();
        return Response::json(array(
            'success' => true,
            'tagContent' => $tagContent
        ));
    }
} 