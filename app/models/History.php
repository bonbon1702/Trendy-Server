<?php

class History extends \Eloquent {
    protected $guarded = array();

    public $timestamps = true;

    protected $table = 'history';

    public function user(){
        return $this->belongsTo('User','user_id');
    }
}