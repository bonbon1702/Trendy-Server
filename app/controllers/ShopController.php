<?php

use Services\interfaces\IUserService;
use Repositories\interfaces\IUserRepository;
use Core\GoogleMapHelper;
use Services\interfaces\IShopService;
use Services\interfaces\ITagPictureService;
use Services\interfaces\IShopDetailService;

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
     * @var shop detail Service
     */
    private $shopDetailService;

    /**
     * @param UserRepository $userRepository
     * @param UserService $userService
     * @param GoogleMapHelper $googleMapHelper
     * @param ShopService $shopService
     */
    public function __construct(IUserRepository $userRepository, IUserService $userService, GoogleMapHelper $googleMapHelper, IShopService $shopService,ITagPictureService $tagPictureService, IShopDetailService $shopDetailService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
        $this->googleMapHelper = $googleMapHelper;
        $this->shopService = $shopService;
        $this->tagPictureService=$tagPictureService;
        $this->shopDetailService = $shopDetailService;
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

    public function saveShopDetailInfo(){
        $data = Input::all();

        $shopDetail = $this->shopDetailService->create($data);
        return Response::json(array(
            'success' => true,
            'shop_detail' => $shopDetail
        ));
    }

}
