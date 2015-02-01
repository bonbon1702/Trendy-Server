<?php
use Services\LikeService;

class LikeController extends \BaseController
{

    private $likeService;

    function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }


    /**
     * Display a listing of the resource.
     * GET /like
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * GET /like/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /like
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /like/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /like/{id}/edit
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
     * PUT /like/{id}
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
     * DELETE /like/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function likePost($id, $type, $user_id)
    {
        $this->likeService->likeOrDislike(0, $id, $type, $user_id);
        return Response::json(array(
            'success' => true
        ));
    }

    public function likeShop($id, $type, $user_id)
    {
        $this->likeService->likeOrDislike(1, $id, $type, $user_id);
        return Response::json(array(
            'success' => true
        ));
    }

    public function countLikePost($id)
    {
        $count = $this->likeService->countLike(0, $id);

        return Response::json(array(
            'success' => true,
            'like' => $count
        ));
    }

    public function countLikeShop($id)
    {
        $count = $this->likeService->countLike(1, $id);

        return Response::json(array(
            'success' => true,
            'like' => $count
        ));
    }
}