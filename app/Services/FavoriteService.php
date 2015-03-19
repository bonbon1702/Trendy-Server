<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/26/2015
 * Time: 7:34 PM
 */

namespace Services;


use Core\BaseService;
use Repositories\FavoriteRepository;

/**
 * Class FavoriteService
 * @package Services
 */
class FavoriteService implements BaseService
{
    private $favoriteRepository;

    function __construct(FavoriteRepository $favoriteRepository)
    {
        $this->favoriteRepository = $favoriteRepository;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        $favorite = $this->favoriteRepository->create(array(
            'user_id' => $data['user_id'],
            'post_id' => $data['post_id']
        ));
    }

    public function update(array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
    }

    public function unFavorite($user_id, $post_id){
        $this->favoriteRepository->getRecent()
            ->where('user_id', $user_id)
            ->where('post_id', $post_id)
            ->first()->delete();
    }

    public function getUserFavorite($post_id){
        $favorite = $this->favoriteRepository->getWhere('post_id', $post_id)->get();

        return $favorite;
    }

}