<?php

/**
 * Class Album
 */
class Album extends Eloquent
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
    protected $table = 'album';

    /**
     *
     */
    public static function boot()
    {
        //execute the parent's boot method
        parent::boot();

        //delete your related models here, for example
        static::deleting(function ($album) {
            foreach ($album->posts as $post) {
                $post->delete();
            }

        });

    }

    /**
     * @return mixed
     */
    public function posts()
    {
        return $this->belongsToMany('Post', 'post_album', 'post_id', 'album_id');
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

}