<?php

class Follow extends \Eloquent {
	protected $guarded = array();

	public $timestamps = true;

	protected $table = 'follow';

	public function user(){
		return $this->belongsTo('User','user_id');
	}

	public function follower(){
		return $this->belongsTo('User','follower_id');
	}
}