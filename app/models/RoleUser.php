<?php

/**
 * Class RoleUser
 */
class RoleUser extends \Eloquent {
	/**
	 * @var array
     */
	protected $guarded = array();

	/**
	 * @var bool
     */
	public $timestamps = true;

	/**
	 * @var string
     */
	protected $table = 'role_user';

	/**
	 * @return mixed
     */
	public function users(){
		return $this->hasMany('User');
	}
}