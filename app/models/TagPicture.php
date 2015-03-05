<?php

/**
 * Class TagPicture
 */
class TagPicture extends \Eloquent {
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
	protected $table = 'tag_picture';

	/**
	 * @return mixed
     */
	public function post(){
		return $this->belongsTo('Post','post_id');
	}

	/**
	 * @return mixed
     */
	public function shop(){
		return $this->belongsTo('Shop','shop_id');
	}
}