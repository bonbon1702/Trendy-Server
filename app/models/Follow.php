<?php

/**
 * Class Follow
 */
class Follow extends \Eloquent {
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
	protected $table = 'follow';

	/**
	 * @return mixed
     */
	public function user(){
		return $this->belongsTo('User','user_id');
	}

	/**
	 * @return mixed
     */
	public function follower(){
		return $this->belongsTo('User','follower_id');
	}
}