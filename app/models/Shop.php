<?php

/**
 * Class Shop
 */
class Shop extends \Eloquent {
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
	protected $table = 'shop';

	/**
	 * @return mixed
     */
	public function tagPicture(){
		return $this->hasMany('TagPicture');
	}
    /**
     * @return mixed
     */
    public function shopDetail(){
        return $this->hasMany('ShopDetail');
    }
}