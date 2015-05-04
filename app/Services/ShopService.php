<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:35 AM
 */

namespace Services;

use Core\GoogleMapHelper;
use Repositories\interfaces\ILikeRepository;
use Repositories\interfaces\IShopRepository;
use Repositories\interfaces\IUserRepository;
use Services\interfaces\ICommentService;
use Services\interfaces\ILikeService;
use Services\interfaces\IShopDetailService;
use Services\interfaces\IShopService;
use Services\interfaces\ITagPictureService;
use Core\ItemToItem;

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
     * @var
     */
    private $likeRepository;

    /**
     * @var
     */
    private $userRepository;


    /**
     * @param IShopRepository $shopRepository
     * @param GoogleMapHelper $googleMapHelper
     * @param ILikeService $likeService
     * @param ICommentService $commentService
     * @param ITagPictureService $tagPictureService
     * @param IShopDetailService $shopDetailService
     * @param ILikeRepository $likeRepository
     * @param IUserRepository $userRepository
     */
    function __construct(IShopRepository $shopRepository, GoogleMapHelper $googleMapHelper, ILikeService $likeService, ICommentService $commentService, ITagPictureService $tagPictureService, IShopDetailService $shopDetailService, ILikeRepository $likeRepository, IUserRepository $userRepository)
    {
        // TODO: Implement __construct() method.
        $this->shopRepository = $shopRepository;
        $this->googleMapHelper = $googleMapHelper;
        $this->likeService = $likeService;
        $this->commentService = $commentService;
        $this->tagPictureService = $tagPictureService;
        $this->shopDetailService = $shopDetailService;
        $this->likeRepository = $likeRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getShopByShopId($id)
    {
        $shop = $this->shopRepository->getRecent()->where('id',$id)->first();
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
    public function checkExist($image_url_editor,$address)
    {
        $check = $this->shopRepository->getWhere('address', $address);
        if ($check)
            return $check;
        else {
            $cor = $this->googleMapHelper->findCoordinate($address);
            $shop = $this->shopRepository->create(array(
                'address' => $address,
                'image_url' => $image_url_editor,
                'lat' => $cor[0]['latitude'],
                'long' => $cor[0]['longitude']
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
            ->Leftjoin('shop_detail', 'shop_detail.shop_id', '=', 'shop.id')
            ->where('shop.name', 'LIKE', '%' . $type . '%')
            ->orWhere('shop.address', 'LIKE', '%' .$type . '%')
            ->orWhere('shop_detail.name', 'LIKE', '%' .$type . '%')
            ->where('shop_detail.approve', 1)
            ->get();

        return $shop;
    }

    /**
     * @param
     * @return mixed
     */
    public function getShopList()
    {
        $shop = $this->shopRepository->all();
        foreach ($shop as $v){
            $v['shop_details'] = $this->shopDetailService->getShopDetail($v->id);
        }
        return $shop;
    }

    public function suggestShop($loginId, $shopId){
        $shops = $this->shopRepository->getRecent()
            ->select('shop.id')
            ->get();
        $users = $this->userRepository->getRecent()
            ->select('users.id')
            ->get();
        $matrix = array();
        foreach ($users as $v){
            $matrix[$v->id] = array();
            foreach ($shops as $v1){
                $check = $this->likeRepository->getRecent()
                    ->where('type_like', 1)
                    ->where('type_id', $v1->id)
                    ->where('user_id', $v->id)
                    ->get();

                if (count($check) > 0) {
                    $matrix[$v->id][$v1->id] = 1;
                } else {
                    $matrix[$v->id][$v1->id] = 0;
                }
            }
        }
        $itemToItem = new ItemToItem();
        $itemToItem->insert($matrix);
        $results = $itemToItem->predict($shopId);


        $suggestions = array();
        foreach ($results as $k =>$v){
            $shop = $this->shopRepository->get($k);
            $shop['cosine'] = $v;
            $suggestions[] = $shop;
        }

        usort($suggestions, function ($item1, $item2) {
            $result = 0;
            if ($item1['cosine'] < $item2['cosine']) {
                $result = 1;
            } else if ($item1['cosine'] > $item2['cosine']) {
                $result = -1;
            }
            return $result;
        });

        $suggestions = array_slice($suggestions, 0, 3);

        $likes = $this->likeRepository->getRecent()
            ->where('user_id',$loginId)
            ->where('type_like', 1)
            ->get();
        foreach ($suggestions as $k => $v){
            foreach ($likes as $t){
                if ($v->id == $t->type_id) unset($suggestions[$k]);
            }
        }

        return $suggestions;
    }
}