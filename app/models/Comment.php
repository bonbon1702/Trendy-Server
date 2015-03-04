<?php

/**
 * Class Comment
 */
class Comment extends \Eloquent {
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
	protected $table = 'comment';

	/**
	 * @return mixed
     */
	public function user(){
		return $this->belongsTo('User','user_id');
	}
}