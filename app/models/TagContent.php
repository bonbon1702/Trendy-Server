<?php

class TagContent extends \Eloquent {
	protected $guarded = array();

	public $timestamps = true;

	protected $table = 'tag_content';

	public function tag(){
		return $this->hasMany('Tag');
	}
}