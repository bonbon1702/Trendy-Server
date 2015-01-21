<?php

use Services\UserService;
use Repositories\UserRepository;
use Core\GoogleMapHelper;
use Services\ShopService;

class ShopController extends BaseController
{
    /**
     * @var userRepository
     */
    private $userRepository;
    /**
     * @var user Service
     */
    private $userService;

    private $googleMapHelper;

    private $shopService;

    public function __construct(UserRepository $userRepository, UserService $userService, GoogleMapHelper $googleMapHelper, ShopService $shopService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
        $this->googleMapHelper = $googleMapHelper;
        $this->shopService = $shopService;
    }

    public function showShop($name)
    {
        $user = $this->userRepository->getRecent();

        return View::make('Shoppage.shop', array(
            'user' => $user
        ));
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
        return Response::json(array(
            'success' => true
        ));
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

        $results = $this->shopService->searchShop($data['type']);

        return Response::json(array(
            'success' => true,
            'data' => $results
        ));
    }
}
