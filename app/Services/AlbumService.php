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
use Repositories\PostAlbumRepository;

/**
 * Class AlbumService
 * @package Services
 */
class AlbumService implements BaseService
{

    /**
     * @var AlbumRepository
     */
    private $albumRepository;

    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var PostAlbumRepository
     */
    private $postAlbumRepository;

    /**
     * @param AlbumRepository $albumRepository
     * @param PostRepository $postRepository
     * @param UserRepository $userRepository
     * @param PostAlbumRepository $postAlbumRepository
     */
    function __construct(AlbumRepository $albumRepository, PostRepository $postRepository, UserRepository $userRepository,PostAlbumRepository $postAlbumRepository)
    {
        // TODO: Implement __construct() method.
        $this->albumRepository = $albumRepository;
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
        $this->postAlbumRepository = $postAlbumRepository;
    }

    /**
     * @param array $data
     * @return mixed
     */
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

    /**
     * @param array $data
     * @return bool
     */
    public function update(array $data)
    {
        // TODO: Implement update() method.
        //if ($this->albumRepository->update($model,$data))
        return true;
    }

    /**
     * @param $column
     * @param $value
     */
    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
        $this->albumRepository->deleteWhere($column, $value);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getListAlbumOfUser($id)
    {
        return $this->albumRepository->getAlbumOfUser($id);
    }

    /**
     * @param $album_name
     * @param $user_id
     * @return mixed
     */
    public function getAlbumDetail($album_name,$user_id)
    {
        return $this->albumRepository->joinPostAndAlbumAndPostAlbum()
                                        ->select('post_id', 'name', 'image_url_editor', 'caption', 'post.created_at', 'post.updated_at')
                                            ->where('album_name', $album_name)
                                                ->where('album.user_id','=',$user_id)
                                                    ->get();
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function getAlbum($userId)
    {
        return $this->albumRepository->getRecent()
                                        ->where('user_id', '=', $userId)
                                            ->groupBy('album_name')->get();
    }

    /**
     * @param $album_name
     */
    public function deleteAlbum($album_name)
    {
        $albums =$this->albumRepository->joinPostAndAlbumAndPostAlbum()
                                            ->select('post_id')
                                                ->where('album_name',$album_name)
                                                    ->get();
        foreach($albums as $v){
            $this->postRepository->delete($v->post_id);
            $this->postAlbumRepository->getRecent()->where('post_id', $v->post_id)->delete();
        }
    }

}