<?php

class Tag extends \Eloquent {
	protected $guarded = array();

	public $timestamps = true;

	protected $table = 'tag';

	public function post(){
		return $this->belongsTo('Post','post_id');
	}

	public function tagLinkContent(){
		return $this->hasMany('TagLinkContent');
	}
}