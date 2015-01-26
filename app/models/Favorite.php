<?php

class Favorite extends \Eloquent {
	protected $guarded = array();

	public $timestamps = true;

	protected $table = 'favorite';

	public function user(){
		return $this->belongsTo('User','user_id');
	}
}