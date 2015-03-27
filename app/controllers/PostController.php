<?php

use Repositories\PostRepository;
use Repositories\UploadRepository;
use Repositories\UserRepository;
use Services\PostService;
use Services\UserService;
use Services\FavoriteService;
use Services\interfaces\IPostService;

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

    private $favoriteService;

    /**
     * @param UserRepository $userRepository
     * @param UserService $userService
     * @param PostRepository $postRepository
     * @param PostService $postService
     * @param UploadRepository $uploadRepository
     */
    public function __construct(UserRepository $userRepository, UserService $userService, PostRepository $postRepository, IPostService $postService, UploadRepository $uploadRepository, FavoriteService $favoriteService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
        $this->postRepository = $postRepository;
        $this->uploadRepository = $uploadRepository;
        $this->postService = $postService;
        $this->favoriteService = $favoriteService;
    }

    /**
     * Display a listing of the resource.
     * GET /post
     *
     * @return Response
     */
    public function index()
    {
        //
        $posts = $this->postService->allPost();
        return Response::json(array(
            'success' => true,
            'posts' => $posts
        ));
    }

    /**
     * Show the form for creating a new resource.
     * GET /post/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /post
     *
     * @return Response
     */
    public function store()
    {
        //
        $data = Input::all();

        $this->postService->create($data);

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
    public function show($id)
    {
        //
        $post = $this->postService->getPostDetails($id);
        return Response::json(array(
            'success' => true,
            'post' => $post
        ));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /post/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /post/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
        $data = Input::all();

        $this->postService->update($data);

        return Response::json(array(
            'success' => true
        ));
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /post/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->postService->delete('id', $id);

        return Response::json(array(
            'success' => true,
        ));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deletePost($id)
    {
//        $data = Input::all();
        $this->postService->deletePost($id);
        return Response::json(array(
            'success' => true
        ));
    }

    public function getPostTrendy($id){
        $posts = $this->postService->getPostPaging('zScore', $id, "none");

        return Response::json(array(
            'success' => true,
            'posts' => $posts
        ));
    }

    public function getPostAround($id){
        $posts = $this->postService->getPostPaging('zScore', $id, "none");

        return Response::json(array(
            'success' => true,
            'posts' => $posts
        ));
    }

    public function getPostFavorite($id, $user_id){
        $posts = $this->postService->getPostPaging('favorite', $id, $user_id);

        return Response::json(array(
            'success' => true,
            'posts' => $posts
        ));
    }

    public function getPostNewFeed($id,$user_id){
        $posts = $this->postService->getPostPaging('newfeed', $id, $user_id);

        return Response::json(array(
            'success' => true,
            'posts' => $posts
        ));
    }

}