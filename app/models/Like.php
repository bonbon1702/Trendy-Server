<?php

class Like extends \Eloquent {
	protected $guarded = array();

	public $timestamps = true;

	protected $table = 'like';

	public function user(){
		return $this->belongsTo('User','user_id');
	}
}