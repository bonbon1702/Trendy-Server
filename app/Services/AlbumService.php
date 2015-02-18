<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:29 AM
 */

namespace Services;


use Core\BaseService;
use Repositories\AlbumRepository;
use Repositories\PostRepository;
use Repositories\UserRepository;

class AlbumService implements BaseService
{

    private $albumRepository;

    private $postRepository;

    function __construct(AlbumRepository $albumRepository, PostRepository $postRepository, UserRepository $userRepository)
    {
        // TODO: Implement __construct() method.
        $this->albumRepository = $albumRepository;
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        $user_id = $data['user_id'];
        $album_name = $data['album_name'];
        $album = $this->albumRepository->create(array(
            'album_name' => $album_name,
            'user_id' => $user_id,
        ));
        return $album;
    }

    public function update(array $data)
    {
        // TODO: Implement update() method.
        //if ($this->albumRepository->update($model,$data))
        return true;
    }

    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
        $this->albumRepository->delete($column, $value);
    }

    public function getListAlbumOfUser($id)
    {
        return $this->albumRepository->getAlbumOfUser($id);
    }

    public function getAlbumDetail($album_name,$user_id)
    {
        return $this->albumRepository->joinPostAndAlbumAndPostAlbum()
                                        ->select('post_id', 'name', 'image_url_editor', 'caption', 'post.created_at', 'post.updated_at')
                                            ->where('album_name', $album_name)
                                                ->where('album.user_id','=',$user_id)
                                                    ->get();
    }

    public function getAlbum($userId)
    {
        return $this->albumRepository->getRecent()
                                        ->where('user_id', '=', $userId)
                                            ->groupBy('album_name')->get();
    }

}