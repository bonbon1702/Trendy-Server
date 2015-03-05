<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 3/3/15
 * Time: 9:01 PM
 */

class Notification extends \Eloquent{
    protected $guarded = array();

    public $timestamps = true;

    protected $table = 'notification';

    public function user(){
        return $this->belongsTo('User','user_id');
    }
} 