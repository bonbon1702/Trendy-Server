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
        $data = Input::all();
        $album = $this->albumService->create($data);

        return Response::json(array(
            'success' => true,
            'album' => $album
        ));
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
        //$data = Input::all();
        $album = $this->albumService->getListAlbumOfUser($id);
        return Response::json(array(
            'success' => true,
            'album' => $album
        ));
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
	 * DELETE /album/{name}
	 *
	 * @param  int  $name
	 * @return Response
	 */
	public function destroy($name)
	{
		//
        $this->albumService->delete('album_name',$name);
	}

    public function getAlbum($id, $name){
        $album = $this->albumService->albumContent($id, $name);

        return Response::json(array(
            'success' => true,
            'album' => $album
        ));
    }

}