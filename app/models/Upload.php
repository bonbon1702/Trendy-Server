<?php

class Upload extends \Eloquent {
	protected $guarded = array();

	public $timestamps = true;

	protected $table = 'upload';

	public function user(){
		return $this->belongsTo('User','user_id');
	}
}