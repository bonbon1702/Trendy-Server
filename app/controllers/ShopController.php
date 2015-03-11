<?php

use Services\UserService;
use Repositories\UserRepository;
use Core\GoogleMapHelper;
use Services\ShopService;
use Services\TagPictureService;

/**
 * Class ShopController
 */
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

    /**
     * @var GoogleMapHelper
     */
    private $googleMapHelper;

    /**
     * @var ShopService
     */
    private $shopService;

    /**
     * @param UserRepository $userRepository
     * @param UserService $userService
     * @param GoogleMapHelper $googleMapHelper
     * @param ShopService $shopService
     */
    public function __construct(UserRepository $userRepository, UserService $userService, GoogleMapHelper $googleMapHelper, ShopService $shopService,TagPictureService $tagPictureService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
        $this->googleMapHelper = $googleMapHelper;
        $this->shopService = $shopService;
        $this->tagPictureService=$tagPictureService;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function show($id)
    {
        $shop = $this->shopService->getShopByShopId($id);

        return Response::json(array(
            'success' => true,
            'shop' => $shop
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
        return Response::json(array(
            'success' => true
        ));
    }

    /**
     * @param $type
     * @return mixed
     */
    public function searchShop($type){
        $results = $this->shopService->searchShop($type);

        return Response::json(array(
            'success' => true,
            'data' => $results
        ));
    }

    public function getShopPaging($id,$offSet){
        $shop= $this->tagPictureService->getPagingPostInShopByShopId($id,$offSet);
        return Response::json(array(
            'success' => true,
            'shops' => $shop
        ));
    }

    /**
     * @param
     * @return mixed
     */
    public function getShopList(){
        $results = $this->shopService->getShopList();

        return Response::json(array(
            'success' => true,
            'data' => $results
        ));
    }
}
