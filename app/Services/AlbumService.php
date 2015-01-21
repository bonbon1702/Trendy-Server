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

class AlbumService implements BaseService{

    private $albumRepository;

    private $postRepository;

    function __construct(AlbumRepository $albumRepository, PostRepository $postRepository)
    {
        // TODO: Implement __construct() method.
        $this->albumRepository = $albumRepository;
        $this->postRepository = $postRepository;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        $post_id = $data['postId'];
//        $user_id = $this->userRepository->getRecent()->id;
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

    public function update($model, array $data)
    {
        // TODO: Implement update() method.
        if ($this->AlbumRepository->update($model,$data))
            return true;
    }

    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
        if ($this->AlbumRepository->delete($column,$value))
            return true;
    }

}