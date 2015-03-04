<?php

/**
 * Class Tag
 */
class Tag extends \Eloquent {
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
	protected $table = 'tag';

	/**
	 * @return mixed
     */
	public function post(){
		return $this->belongsTo('Post','post_id');
	}

	/**
	 * @return mixed
     */
	public function tagContent(){
		return $this->belongsTo('TagContent','tag_content_id');
	}
}