<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 14/3/2015
 * Time: 10:49 AM
 */

use Services\ShopDetailService;

/**
 * Class UserController
 */
class ShopDetailController extends BaseController
{
    /**
     * @var shop detail Service
     */
    private $shopDetailService;


    /**
     * @param ShopDetailService $shopDetailService
     */
    public function __construct(ShopDetailService $shopDetailService)
    {
        $this->shopDetailService = $shopDetailService;
    }

    /**
     * @return mixed
     */
    public function store()
    {
        $data = Input::all();

        $shopDetail = $this->shopDetailService->create($data);
        return Response::json(array(
            'success' => true,
            'shop_detail' => $shopDetail
        ));
    }
}