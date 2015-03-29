<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:35 AM
 */

namespace Services;

use Core\GoogleMapHelper;
use Repositories\interfaces\IShopRepository;
use Services\interfaces\ICommentService;
use Services\interfaces\ILikeService;
use Services\interfaces\IShopDetailService;
use Services\interfaces\IShopService;
use Services\interfaces\ITagPictureService;

/**
 * Class ShopService
 * @package Services
 */
class ShopService implements IShopService
{

    /**
     * @var ShopRepository
     */
    private $shopRepository;

    /**
     * @var LikeService
     */
    private $likeService;
    /**
     * @var CommentService
     */
    private $commentService;

    /**
     * @var ITagPictureService
     */
    private $tagPictureService;

    /**
     * @var IShopDetailService
     */
    private $shopDetailService;


    /**
     * @param IShopRepository $shopRepository
     * @param GoogleMapHelper $googleMapHelper
     * @param ILikeService $likeService
     * @param ICommentService $commentService
     * @param ITagPictureService $tagPictureService
     * @param IShopDetailService $shopDetailService
     */
    function __construct(IShopRepository $shopRepository, GoogleMapHelper $googleMapHelper, ILikeService $likeService, ICommentService $commentService, ITagPictureService $tagPictureService, IShopDetailService $shopDetailService)
    {
        // TODO: Implement __construct() method.
        $this->shopRepository = $shopRepository;
        $this->googleMapHelper = $googleMapHelper;
        $this->likeService = $likeService;
        $this->commentService = $commentService;
        $this->tagPictureService = $tagPictureService;
        $this->shopDetailService = $shopDetailService;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getShopByShopId($id)
    {
        $shop = $this->shopRepository->get($id);
        $shop['shop_detail'] = $this->shopDetailService->getShopDetail($id);
        $shop['like'] = $this->likeService->countLike(1, $id);
        $shop['comments'] = $this->commentService->showCommentByShopId($id);
        $shop['posts'] = $this->tagPictureService->getPostInShopByShopId($id);
        return $shop;
    }


    /**
     * @param $result
     * @return mixed
     */
    public function checkCoordinates($result)
    {
        $lat = $result[0]->getLatitude();
        $long = $result[0]->getLongitude();
        $address = $result[0]->getStreetNumber() . ' ' . $result[0]->getStreetName() . ' ' . $result[0]->getCounty() . ' ' . $result[0]->getCountry();
        $shop_1 = $this->shopRepository->getWhere('lat', $lat);

        $shop_2 = $this->shopRepository->getWhere('long', $long);
        if (!empty($shop_1) && !empty($shop_2)) {
            if ($shop_1->id === $shop_2->id) {
                return $shop_1;
            }
        }


        $shop = $this->shopRepository->create(array(
            'address' => $address
        ));

        return $shop;

    }

    /**
     * @param $type
     * @return mixed
     */
    public function searchShop($type)
    {
        $shop = $this->shopRepository->getRecent()
            ->where('address', 'LIKE', '%' . $type . '%')->get();

        return $shop;
    }

    /**
     * @param $address
     * @return mixed
     */
    public function checkExist($address)
    {
        $check = $this->shopRepository->getWhere('address', $address);
        if ($check)
            return $check;
        else {
            $shop = $this->shopRepository->create(array(
                'address' => $address,
                'image_url' => 'http://images.fashiontimes.com/data/images/full/4853/versace.jpg'
            ));

            return $shop;
        }
    }

    /**
     * @param $type
     * @return mixed
     */
    public function searchFullText($type)
    {
        $shop = $this->shopRepository->getRecent()
            ->where('name', 'LIKE', '%' . $type . '%')->get();

        return $shop;
    }

    /**
     * @param
     * @return mixed
     */
    public function getShopList()
    {
        $shop = $this->shopRepository->all();
        return $shop;
    }
}