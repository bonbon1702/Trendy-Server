<?php

/**
 * Class Favorite
 */
class Favorite extends \Eloquent {
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
	protected $table = 'favorite';

	/**
	 * @return mixed
     */
	public function user(){
		return $this->belongsTo('User','user_id');
	}
}