<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 11/6/2014
 * Time: 9:54 AM
 */

namespace Core;

use Geocoder\Geocoder;
use Geocoder\HttpAdapter\CurlHttpAdapter;
use Geocoder\Provider\GoogleMapsProvider;
use League\Geotools\Geotools;
use League\Geotools\Coordinate\Coordinate;

class GoogleMapHelper {
    /**
     * @var geocoder
     */
    private $geoCoder;

    /**
     * @var adapter
     */
    private $adapter;

    /**
     * @var geoTools
     */
    private $geoTools;

    public function __construct(CurlHttpAdapter $adapter, Geocoder $geoCoder, Geotools $geoTools)
    {
        $this->adapter = $adapter;
        $this->geoCoder = $geoCoder;
        $this->geoTools = $geoTools;
        $this->registerProviders();
    }

    protected function registerProviders(){
        $this->geoCoder->registerProviders(array(
            new GoogleMapsProvider($this->adapter),
        ));
    }

    /**
     * @param $address
     * @return \Geocoder\Result\ResultInterface|\Geocoder\ResultInterface|null
     */
    public function findCoordinate($address){
        $results = null;

        if ($address){
            $results  = $this->geoTools->batch($this->geoCoder)->geocode(array(
                            $address
            ))->parallel();
        }
        return $results;
    }

    public function findAddress($latitude, $longitude){
        $results = null;

        if ($latitude && $longitude){
            $results  = $this->geoTools->batch($this->geoCoder)->reverse(array(
                new Coordinate(array($latitude, $longitude))
            ))->parallel();
        }
        return $results;
    }



} 