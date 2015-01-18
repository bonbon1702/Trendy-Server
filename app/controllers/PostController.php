<?php

use Services\UserService;
use Repositories\UserRepository;
use Repositories\PostRepository;
use Services\PostService;
use Repositories\UploadRepository;

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

    private $postRepository;

    private $postService;

    private $uploadRepository;

    public function __construct(UserRepository $userRepository, UserService $userService, PostRepository $postRepository, PostService $postService,UploadRepository $uploadRepository)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
        $this->postRepository = $postRepository;
        $this->uploadRepository = $uploadRepository;
        $this->postService = $postService;
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
        $user = $this->userRepository->getRecent();

        return View::make('Postpage.post', array(
            'user' => $user
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
        //
    }

    public function editor()
    {
        $user = $this->userRepository->getRecent();

//        if ($image && $user){
//            $user_name = $user->username;
//            $image_name = $user_name .'_'.pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME );
//            Cloudy::upload($image->getRealPath(), $image_name);

        $img = Input::file('image');

        $image = Image::make($img);
//        $image_name = strstr($user->email, '@', true) . '_' . $img->getClientOriginalName();
        $image_name = \Core\Helper::get_rand_alphanumeric(8);
        $image_url = 'assets/images/' .$image_name.'.jpg';

        $image->save($image_url);

        $upload = $this->uploadRepository->create(array(
            'user_id' => $user->id,
            'image_url' => $image_url,
            'name' => $image_name
        ));

        return View::make('Homepage.editor', array(
            'user' => $user,
            'upload' => $upload
        ));
    }

    public function caption($name)
    {
        $user = $this->userRepository->getRecent();
        $upload = $this->uploadRepository->getWhere('name',$name);

        return View::make('Homepage.caption', array(
            'user' => $user,
            'upload' => $upload
        ));
    }

}