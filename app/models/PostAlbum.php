<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 2/9/15
 * Time: 4:30 PM
 */

class PostAlbum extends Eloquent{
    protected $guarded = array();

    public $timestamps = true;

    protected $table = 'post_album';
} 