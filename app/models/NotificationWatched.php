<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 3/3/15
 * Time: 9:01 PM
 */

class NotificationWatched extends \Eloquent{
    protected $guarded = array();

    public $timestamps = true;

    protected $table = 'notification_watched';

    public function user(){
        return $this->belongsTo('User','user_id');
    }
    public function notification(){
        return $this->belongsTo('Notification','notification_id');
    }
} 