<?php

use Repositories\interfaces\IPostRepository;
use Repositories\interfaces\IUploadRepository;
use Repositories\interfaces\IUserRepository;
use Services\interfaces\IPostService;
use Services\interfaces\IUserService;
use Services\interfaces\IFavoriteService;

/**
 * Class PostController
 */
class PostController extends \BaseController
{
    /**
     * @var userRepository
     */
    private $userRepository;
    /**
     * @var user Service
     */
    private $userService;

    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * @var PostService
     */
    private $postService;

    /**
     * @var UploadRepository
     */
    private $uploadRepository;

    /**
     * @var IFavoriteService
     */
    private $favoriteService;


    /**
     * @param IUserRepository $userRepository
     * @param IUserService $userService
     * @param IPostRepository $postRepository
     * @param IPostService $postService
     * @param IUploadRepository $uploadRepository
     * @param IFavoriteService $favoriteService
     */
    public function __construct(IUserRepository $userRepository, IUserService $userService, IPostRepository $postRepository, IPostService $postService, IUploadRepository $uploadRepository, IFavoriteService $favoriteService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
        $this->postRepository = $postRepository;
        $this->uploadRepository = $uploadRepository;
        $this->postService = $postService;
        $this->favoriteService = $favoriteService;
    }

    /**
     * @return mixed
     */
    public function createPost(){
        $data = Input::all();

        $this->postService->createPost($data);

        return Response::json(array(
            'success' => true
        ));
    }

    /**
     * Display the specified resource.
     * GET /post/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function getPostById($id)
    {
        //
        $post = $this->postService->getPostDetails($id);
        return Response::json(array(
            'success' => true,
            'post' => $post
        ));
    }


    /**
     * Update the specified resource in storage.
     * PUT /post/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function updatePost($id)
    {
        $data = Input::all();

        $this->postService->update($data);

        return Response::json(array(
            'success' => true
        ));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deletePostById($id)
    {
        $this->postService->deletePost($id);
        return Response::json(array(
            'success' => true
        ));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPostTrendy($id, $tag){

        $posts = $this->postService->getPostTrendy($id, $tag);

        return Response::json(array(
            'success' => true,
            'posts' => $posts
        ));
    }

    /**
     * @param $id
     * @param $lat
     * @param $long
     * @return mixed
     */
    public function getPostAround($id, $lat, $long){
        $posts = $this->postService->getPostAround($id,$lat,$long);

        return Response::json(array(
            'success' => true,
            'posts' => $posts
        ));
    }

    /**
     * @param $id
     * @param $user_id
     * @return mixed
     */
    public function getPostFavorite($id, $user_id){
        $posts = $this->postService->getPostFavorite($id, $user_id);

        return Response::json(array(
            'success' => true,
            'posts' => $posts
        ));
    }

    /**
     * @param $id
     * @param $user_id
     * @return mixed
     */
    public function getPostNewFeed($id,$user_id){
        $posts = $this->postService->getPostNewFeed($id, $user_id);

        return Response::json(array(
            'success' => true,
            'posts' => $posts
        ));
    }

    public function editPostCaption($id, $caption){
        $this->postService->editPostCaption($id, $caption);

        return Response::json(array(
            'success' => true
        ));
    }

}