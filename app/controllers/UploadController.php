<?php

use Repositories\UploadRepository;
use Repositories\UserRepository;
use Services\interfaces\IUploadService;

/**
 * Class UploadController
 */
class UploadController extends \BaseController {

	/**
	 * @var UploadService
     */
	private $uploadService;

	/**
	 * @param UploadService $uploadService
     */
	function __construct(IUploadService $uploadService)
	{
		$this->uploadService = $uploadService;
	}

	/**
	 * Display a listing of the resource.
	 * GET /upload
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /upload/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
	 * @param  String  $name
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
	 * Show the form for editing the specified resource.
	 * GET /upload/{id}/edit
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
	 * PUT /upload/{name}
	 *
	 * @param  int  $name
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
	 * Remove the specified resource from storage.
	 * DELETE /upload/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/**
	 * @return mixed
     */
	public function uploadEditor(){
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