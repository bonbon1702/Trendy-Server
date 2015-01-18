<?php

class Post extends \Eloquent {
	protected $guarded = array();

	public $timestamps = true;

	protected $table = 'post';

	public function album(){
		return $this->hasMany('Album');
	}

	public function tag(){
		return $this->hasMany('Tag');
	}

	public function tagPicture(){
		return $this->hasMany('TagPicture');
	}
}