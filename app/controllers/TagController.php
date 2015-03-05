<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 22/1/2015
 * Time: 3:51 PM
 */

use Repositories\TagRepository;
use Services\TagService;

/**
 * Class TagController
 */
class TagController extends  BaseController{

    /**
     * @var TagService
     */
    private $tagService;
    /**
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * @param TagService $tagService
     * @param TagRepository $tagRepository
     */
    public function __construct(TagService $tagService,TagRepository $tagRepository){
        $this->tagService=$tagService;
        $this->tagRepository=$tagRepository;
    }




    /**
     * Display all follower by user
     *
     * GET/tag
     * @return Response
     */
    public function index(){
        $tag=$this->tagService->listAllTag();

        return Response::json(array(
            'success'=>'true',
            'tag'=>$tag
        ));
    }
    /**
     * Display all follow
     * POST/tag
     *
     * @return Response
     */
    public function  store(){
        $data=Input::all();
        $this->tagService->create($data);
        return Response::json(array(
            'success'=>true
        ));
    }

    /**
     * Update the specified resource in storage.
     * PUT/tag
     *
     * @return Response
     */
    public function update($postId)
    {
        $data=Input::all();
        $data['post_id'] = $postId;
        $this->tagService->update($data);
        return Response::json(array(
            'success'=>true
        ));
    }


    /**
     * Remove the specified Follow from storage.
     * DELETE/follow
     *
     * @return Response
     */
    public function destroy($postId)
    {
        $data=Input::all();
        $this->tagService->delete('post_id',$postId);
        return Response::json(array(
            'success' => true
        ));
    }
}