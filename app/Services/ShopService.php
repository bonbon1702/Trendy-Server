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

class ShopService implements BaseService{

    private $shopRepository;

    function __construct(ShopRepository $shopRepository, GoogleMapHelper $googleMapHelper)
    {
        // TODO: Implement __construct() method.
        $this->shopRepository = $shopRepository;
        $this->googleMapHelper = $googleMapHelper;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.

    }

    public function update($model, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
    }

    public function checkCoordinates($result){
        $lat = $result[0]->getLatitude();
        $long = $result[0]->getLongitude();
        $address = $result[0]->getStreetNumber().' '. $result[0]->getStreetName(). ' '. $result[0]->getCounty(). ' '. $result[0]->getCountry();
        $shop_1 = $this->shopRepository->getWhere('lat', $lat);

        $shop_2 = $this->shopRepository->getWhere('long', $long);
        if (!empty($shop_1) && !empty($shop_2)) {
            if ($shop_1->id === $shop_2->id) {
                return $shop_1;
            }
        }


        $shop = $this->shopRepository->create(array(
            'lat' => $lat,
            'long' => $long,
            'address' => $address
        ));

        return $shop;

    }
}