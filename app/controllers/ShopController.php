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
     * @param IUserRepository $userRepository
     * @param IUserService $userService
     * @param GoogleMapHelper $googleMapHelper
     * @param IShopService $shopService
     * @param ITagPictureService $tagPictureService
     * @param IShopDetailService $shopDetailService
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
     * @param $id
     * @return mixed
     */
    public  function getShopByShopId($id){
        $shop = $this->shopService->getShopByShopId($id);

        return Response::json(array(
            'success' => true,
            'shop' => $shop
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

    /**
     * @param $id
     * @param $offSet
     * @return mixed
     */
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

    /**
     * @return mixed
     */
    public function saveShopDetailInfo(){
        $data = Input::all();

        $shopDetail = $this->shopDetailService->saveShopDetailInfo($data);
        return Response::json(array(
            'success' => true,
            'shop_detail' => $shopDetail
        ));
    }

}
