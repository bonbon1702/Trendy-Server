<?php

class Album extends \Eloquent {
	protected $guarded = array();

	public $timestamps = true;

	protected $table = 'album';

	public function user(){
		return $this->belongsTo('User','user_id');
	}

	public function posts(){
        return $this->belongsToMany('Album','post_album', 'post_id', 'album_id');
	}

}