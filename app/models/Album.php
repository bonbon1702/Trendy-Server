<?php

class Album extends \Eloquent {
	protected $guarded = array();

	public $timestamps = true;

	protected $table = 'album';

	public function user(){
		return $this->belongsTo('User','user_id');
	}

	public function post(){
		return $this->belongsTo('Post','post_id');
	}

}