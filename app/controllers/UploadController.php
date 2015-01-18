<?php

use Repositories\UploadRepository;

class UploadController extends \BaseController {

	protected $uploadRepository;

	function __construct(UploadRepository $uploadRepository)
	{
		$this->uploadRepository = $uploadRepository;
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
		$data = Input::all();

		$img = Image::make($data['img']);
		$image_name = $data['name'];
		$upload = $this->uploadRepository->getWhere('name',$image_name);
		$image_name_editor = \Core\Helper::get_rand_alphanumeric(8);
		$image_url = 'assets/images/' .$image_name_editor . '.jpg';

		$img->save($image_url);

		$this->uploadRepository->update($upload,array(
			'image_url_editor' => $image_url
		));


		return Response::json(array(
			'success' => true
		));
	}

	/**
	 * Display the specified resource.
	 * GET /upload/{id}
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
	 * PUT /upload/{id}
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
	 * DELETE /upload/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}