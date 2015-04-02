<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 13/3/2015
 * Time: 4:59 PM
 */

namespace Services;

use Core\GoogleMapHelper;
use Repositories\interfaces\IShopDetailRepository;
use Services\interfaces\IShopDetailService;
use Services\interfaces\ILikeService;
use Services\interfaces\ICommentService;
use Services\interfaces\ITagPictureService;

/**
 * Class ShopService
 * @package Services
 */
class ShopDetailService implements IShopDetailService
{


    /**
     * @var ShopDetailRepository
     */
    private $shopDetailRepository;

    /**
     * @var LikeService
     */
    private $likeService;
    /**
     * @var CommentService
     */
    private $commentService;

    /**
     * @var TagPictureService
     */
    private $tagPictureService;


    /**
     * @param IShopDetailRepository $shopDetailRepository
     * @param GoogleMapHelper $googleMapHelper
     * @param ILikeService $likeService
     * @param ICommentService $commentService
     * @param ITagPictureService $tagPictureService
     */
    function __construct(IShopDetailRepository $shopDetailRepository, GoogleMapHelper $googleMapHelper, ILikeService $likeService, ICommentService $commentService, ITagPictureService $tagPictureService)
    {
        // TODO: Implement __construct() method.
        $this->shopDetailRepository= $shopDetailRepository;
        $this->googleMapHelper = $googleMapHelper;
        $this->likeService = $likeService;
        $this->commentService = $commentService;
        $this->tagPictureService= $tagPictureService;
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function saveShopDetailInfo(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)) {

            $shopDetail = $this->shopDetailRepository->create(array(
                'shop_id' => $data['shop_id'],
                'name' => $data['name'],
                'street' => $data['street'],
                'district' => $data['district'],
                'city' => $data['city'],
                'near_place' => $data['near_place'],
                'way_direction' => $data['way_direction'],
                'lat' => $data['lat'],
                'long' => $data['long'],
                'time_open' => $data['time_open'],
                'time_close' => $data['time_close'],
                'price_from' => $data['price_from'],
                'price_to' => $data['price_to'],
                'morning' => $data['morning'],
                'midday' => $data['midday'],
                'afternoon' => $data['afternoon'],
                'night' => $data['night'],
                'shipping' => $data['shipping'],
                'credit_card' => $data['credit_card'],
                'cooler' => $data['cooler'],
                'parking' => $data['parking'],
                'children' => $data['children'],
                'teen' => $data['teen'],
                'middleaged' => $data['middleaged'],
                'oldster' => $data['oldster'],
                'men' => $data['men'],
                'women' => $data['women'],
                'tel' => $data['tel'],
                'website' => $data['website'],
                'facebook_page' => $data['facebook_page'],
                'approve' => $data['approve']
            ));
        }

        return $shopDetail;

    }

    /**
     * @param $id
     * @return mixed
     */
    public function getShopDetail($id){
        return $this->shopDetailRepository->getRecent()
                                            ->where('approve','=',1)
                                                ->where('shop_id','=',$id)
                                                    ->get();
    }
}