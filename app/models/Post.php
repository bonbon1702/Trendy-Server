<?php

class Post extends Eloquent {
	protected $guarded = array();

	public $timestamps = true;

	protected $table = 'post';

	public function albums(){
        return $this->belongsToMany('Album','post_album', 'post_id', 'album_id');
	}

	public function tag(){
		return $this->hasMany('Tag');
	}

	public function tagPicture(){
		return $this->hasMany('TagPicture');
	}

	public function user(){
		return $this->belongsTo('User','user_id');
	}
}