<?php

use Services\UserService;
use Repositories\UserRepository;
use Repositories\ShopRepository;
use Core\GoogleMapHelper;

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

    private $shopRepository;

    public function __construct(UserRepository $userRepository, UserService $userService, GoogleMapHelper $googleMapHelper, ShopRepository $shopRepository)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
        $this->googleMapHelper = $googleMapHelper;
        $this->shopRepository = $shopRepository;
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

        $results = $this->shopRepository->search($data['type']);

        return Response::json(array(
            'data' => $results
        ));
    }
}
