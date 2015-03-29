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
    public function store()
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
     * Display the specified resource.
     * GET /upload/{name}
     *
     * @param  String $name
     * @return Response
     */
    public function show($name)
    {
        //
        $upload = $this->uploadService->getUploadImage($name);
        return Response::json(array(
            'success' => true,
            'upload' => $upload
        ));
    }


    /**
     * Update the specified resource in storage.
     * PUT /upload/{name}
     *
     * @param  int $name
     * @return Response
     */
    public function update($name)
    {
        //
        $data = Input::all();
        $data['name'] = $name;
        $upload = $this->uploadService->update($data);

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