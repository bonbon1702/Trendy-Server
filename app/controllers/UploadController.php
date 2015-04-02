<?php

use Services\interfaces\IUploadService;

/**
 * Class UploadController
 */
class UploadController extends \BaseController
{

    /**
     * @var UploadService
     */
    private $uploadService;


    /**
     * @param IUploadService $uploadService
     */
    function __construct(IUploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }


    /**
     * Store a newly created resource in storage.
     * POST /upload
     *
     * @return Response
     */
    public function uploadPicture()
    {
        //
        $img = $_FILES['file']['tmp_name'];

        $upload = $this->uploadService->create(array(
            'img' => $img
        ));

        return Response::json(array(
            'success' => true,
            'upload' => $upload
        ));
    }

    /**
     * @return mixed
     */
    public function uploadEditor()
    {
        $data = Input::all();

        $upload = $this->uploadService->update(array(
            'img' => $data['image'],
            'name' => $data['name']
        ));
        return Response::json(array(
            'success' => true,
            'upload' => $upload
        ));
    }

}