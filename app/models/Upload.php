<?php

/**
 * Class Upload
 */
class Upload extends \Eloquent {
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
	protected $table = 'upload';

	/**
	 * @return mixed
     */
	public function user(){
		return $this->belongsTo('User','user_id');
	}
}