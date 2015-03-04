<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * Class User
 */
class User extends \Eloquent implements UserInterface, RemindableInterface
{

    use UserTrait, RemindableTrait;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $guarded = array();

    /**
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }
    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function role()
    {
        return $this->belongsTo('RoleUser', 'role_id');
    }

    /**
     * @return mixed
     */
    public function album()
    {
        return $this->hasMany('Album');
    }

    /**
     * @return mixed
     */
    public function comments()
    {
        return $this->hasMany('Comment');
    }

    /**
     * @return mixed
     */
    public function follow()
    {
        return $this->hasMany('Follow');
    }

    /**
     * @return mixed
     */
    public function upload()
    {
        return $this->hasMany('Upload');
    }

    /**
     * @return mixed
     */
    public function posts()
    {
        return $this->hasMany('Post');
    }

    /**
     * @return mixed
     */
    public function like()
    {
        return $this->hasMany('Like');
    }

    /**
     * @return mixed
     */
    public function favorite()
    {
        return $this->hasMany('Favorite');
    }

    /**
     * @return mixed
     */
    public function history()
    {
        return $this->hasMany('History');
    }
}
