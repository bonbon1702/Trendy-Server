<?php
use Services\AlbumService;

class AlbumController extends \BaseController {

    private $albumService;

    function __construct(AlbumService $albumService)
    {
        $this->albumService = $albumService;
    }


    /**
	 * Display a listing of the resource.
	 * GET /album
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /album/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        $data = Input::all();
        $this->albumService->create($data);

        return Response::json(array(
            'success' => true
        ));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /album
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /album/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /album/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /album/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /album/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}