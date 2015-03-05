<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 2/9/15
 * Time: 4:30 PM
 */

class PostAlbum extends Eloquent{
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
    protected $table = 'post_album';
} 