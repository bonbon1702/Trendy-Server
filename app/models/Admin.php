<?php

/**
 * Class Admin
 */
class Admin extends Eloquent
{
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
    protected $table = 'admin';
}