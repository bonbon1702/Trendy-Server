<?php

/**
 * Class TagContent
 */
class TagContent extends \Eloquent {
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
	protected $table = 'tag_content';

	/**
	 * @return mixed
     */
	public function tag(){
		return $this->hasMany('Tag');
	}
}