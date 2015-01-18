<?php

class RoleUser extends \Eloquent {
	protected $guarded = array();

	public $timestamps = true;

	protected $table = 'role_user';

	public function users(){
		return $this->hasMany('User');
	}
}