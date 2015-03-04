<?php

/**
 * Class Like
 */
class Like extends \Eloquent {
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
	protected $table = 'like';

	/**
	 * @return mixed
     */
	public function user(){
		return $this->belongsTo('User','user_id');
	}
}