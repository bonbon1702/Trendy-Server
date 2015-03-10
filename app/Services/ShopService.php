<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:35 AM
 */

namespace Services;


use Core\BaseService;
use Core\GoogleMapHelper;
use Repositories\ShopRepository;

/**
 * Class ShopService
 * @package Services
 */
class ShopService implements BaseService
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

    private $tagPictureService;


    /**
     * @param ShopRepository $shopRepository
     * @param GoogleMapHelper $googleMapHelper
     * @param LikeService $likeService
     * @param CommentService $commentService
     */
    function __construct(ShopRepository $shopRepository, GoogleMapHelper $googleMapHelper,LikeService $likeService,CommentService $commentService,TagPictureService $tagPictureService)
    {
        // TODO: Implement __construct() method.
        $this->shopRepository = $shopRepository;
        $this->googleMapHelper = $googleMapHelper;
        $this->likeService = $likeService;
        $this->commentService = $commentService;
        $this->tagPictureService= $tagPictureService;
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.

    }

    /**
     * @param array $data
     */
    public function update(array $data)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $column
     * @param $value
     */
    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
    }

    public function getShopByShopId($id)
    {
        $shop = $this->shopRepository->get($id);
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
}