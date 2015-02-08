<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

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

    public $timestamps = true;

    protected $guarded = array();

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

    public function role()
    {
        return $this->belongsTo('RoleUser', 'role_id');
    }

    public function album()
    {
        return $this->hasMany('Album');
    }

    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function follow()
    {
        return $this->hasMany('Follow');
    }

    public function upload()
    {
        return $this->hasMany('Upload');
    }

    public function posts()
    {
        return $this->hasMany('Post');
    }

    public function like()
    {
        return $this->hasMany('Like');
    }

    public function favorite()
    {
        return $this->hasMany('Favorite');
    }

    public function history()
    {
        return $this->hasMany('History');
    }
}
