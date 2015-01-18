<?php

class Shop extends \Eloquent {
	protected $guarded = array();

	public $timestamps = true;

	protected $table = 'shop';

	public function tagPicture(){
		return $this->hasMany('TagPicture');
	}
}