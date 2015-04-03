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
     * @param $id
     * @return mixed
     */
    public function editAlbumById($id)
    {
        $data = Input::all();
        $data['id'] = $id;
        $this->albumService->update($data);
        return Response::json(array(
            'success' => true
        ));
    }

    /**
     * @param $album_name
     * @return mixed
     */
    public function deleteAlbumByName($album_name)
    {
        $this->albumService->deleteAlbum($album_name);
        return Response::json(array(
            'success' => true
        ));
    }

}