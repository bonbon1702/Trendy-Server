<?php

class TagLinkContent extends \Eloquent {
	protected $guarded = array();

	public $timestamps = true;

	protected $table = 'tag_link_content';

	public function tag(){
		return $this->belongsTo('Tag','tag_id');
	}

	public function tagContent(){
		return $this->belongsTo('TagContent','tag_content_id');
	}
}