<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 13/3/2015
 * Time: 4:51 PM
 */

/**
 * Class Shop
 */
class ShopDetail extends \Eloquent {
    /**
     * @var array
     */
    protected $guarded = array();

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $table = 'shop_detail';

    /**
     * @return mixed
     */
    public function shop(){
        return $this->belongsTo('Shop','shop_id');
    }

}