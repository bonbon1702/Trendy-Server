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

    function __construct(AlbumRepository $albumRepository, PostRepository $postRepository)
    {
        // TODO: Implement __construct() method.
        $this->albumRepository = $albumRepository;
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        $post_id = $data['postId'];
        $user_id = $this->userRepository->getRecent()->id;
        $album_name = $data['aName'];
        $post = $this->postRepository->get($post_id);
        if ($post) {
            $this->albumRepository->create(array(
                'album_name' => $album_name,
                'user_id' => 12,
                'post_id' => $post_id,
            ));
        }
        return true;
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
        // $user_id = $this->userRepository->getRecent()->id;
        return $this->albumRepository->getAlbumOfUser($id);
    }

    public function albumContent($id, $albumName)
    {
        return $this->albumRepository->getAlbumContent($id, $albumName);
    }

}