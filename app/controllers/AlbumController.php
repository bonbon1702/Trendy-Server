<?php

use Services\interfaces\IAlbumService;

/**
 * Class AlbumController
 */
class AlbumController extends \BaseController
{

    /**
     * @var IAlbumService
     */
    private $albumService;

    /**
     * @param IAlbumService $albumService
     */
    function __construct(IAlbumService $albumService)
    {
        $this->albumService = $albumService;
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
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $album = $this->albumService->getListAlbumOfUser($id);
        return Response::json(array(
            'success' => true,
            'album' => $album
        ));
    }

    /**
     * Update the specified resource in storage.
     * PUT /album/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $data = Input::all();
        $data['id'] = $id;
        $this->albumService->update($data);
        return Response::json(array(
            'success' => true
        ));
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /album/{album_name}
     *
     * @param  string $album_name
     * @return Response
     */
    public function destroy($album_name)
    {
        $this->albumService->delete('album_name', $album_name);
        return Response::json(array(
            'success' => true,
        ));
    }

    /**
     * @param $album_name
     * @return mixed
     */
    public function deleteAlbum($album_name)
    {
        $this->albumService->deleteAlbum($album_name);
        return Response::json(array(
            'success' => true
        ));
    }

}