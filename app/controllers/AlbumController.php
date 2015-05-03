<?php

use Services\interfaces\IAlbumService;
use Repositories\interfaces\IUserRepository;

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
     * @var IUserRepository
     */
    private $userRepository;


    /**
     * @param IAlbumService $albumService
     * @param IUserRepository $userRepository
     */
    function __construct(IAlbumService $albumService, IUserRepository $userRepository)
    {
        $this->albumService = $albumService;
        $this->userRepository = $userRepository;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function editAlbumById($id)
    {
        $data = Input::all();
        $data['id'] = $id;
        $check = $this->userRepository->getRecent()
            ->where('remember_token', $data['token'])
            ->first();
        if ($check) {
            $this->albumService->editAlbumById($data);
        }

        return Response::json(array(
            'success' => true
        ));
    }

    /**
     * @return mixed
     */
    public function deleteAlbumByName()
    {
        $data = Input::all();
        $check = $this->userRepository->getRecent()
            ->where('remember_token', $data['token'])
            ->first();
        if ($check) {
            $album_name = $data['albName'];
            $this->albumService->deleteAlbum($album_name, $check->id);
        }

        return Response::json(array(
            'success' => true
        ));
    }

}