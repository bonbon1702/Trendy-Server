<?php

/**
 * Class Post
 */
class Post extends Eloquent
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
    protected $table = 'post';

    /**
     *
     */
    public static function boot()
    {
        //execute the parent's boot method
        parent::boot();

        //delete your related models here, for example
        static::deleting(function ($post) {
            foreach ($post->albums as $album) {
                $album->delete();
            }
            $post->tag()->delete();
            $post->tagPicture()->delete();

        });

    }

    /**
     * @return mixed
     */
    public function albums()
    {
        return $this->belongsToMany('Album', 'post_album', 'post_id', 'album_id');
    }

    /**
     * @return mixed
     */
    public function tag()
    {
        return $this->hasMany('Tag');
    }

    /**
     * @return mixed
     */
    public function tagPicture()
    {
        return $this->hasMany('TagPicture');
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }
}