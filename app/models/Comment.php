<?php

class Comment extends \Eloquent {
	protected $guarded = array();

	public $timestamps = true;

	protected $table = 'comment';

	public function user(){
		return $this->belongsTo('User','user_id');
	}
}