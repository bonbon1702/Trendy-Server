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
    public function index() {
        $tagContent = $this->tagContentRepository->all();
        return Response::json(array(
            'success' => true,
            'tagContent' => $tagContent
        ));
    }

    /**
     * @return mixed
     */
    public function store() {
        $data = Input::all();

        $result = $this->tagContentService->create($data);

        return Response::json(array(
            'success' => true,
            're' => $result
        ));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function update($id) {
        $data = Input::all();
        $data['id'] = $id;
        $this->tagContentService->update($data);

        return Response::json(array(
            'success' => true
        ));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id) {
        $this->tagContentService->deleteTagContent($id);
        return Response::json(array(
            'success' => true,
        ));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id){
        $tag = $this->tagContentService->searchTag($id);

        return Response::json(array(
            'success' => true,
            'tag' => $tag
        ));
    }
} 