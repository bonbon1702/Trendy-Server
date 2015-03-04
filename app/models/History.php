<?php

/**
 * Class History
 */
class History extends \Eloquent {
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
    protected $table = 'history';

    /**
     * @return mixed
     */
    public function user(){
        return $this->belongsTo('User','user_id');
    }
}