<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/26/2015
 * Time: 7:34 PM
 */

namespace Services;


use Repositories\interfaces\IFavoriteRepository;
use Repositories\interfaces\IPostRepository;
use Repositories\interfaces\IUserRepository;
use Services\interfaces\IFavoriteService;
use Services\interfaces\IHistoryService;

/**
 * Class FavoriteService
 * @package Services
 */
class FavoriteService implements IFavoriteService
{
    /**
     * @var IFavoriteRepository
     */
    private $favoriteRepository;

    /**
     * @var IHistoryService
     */
    private $historyService;

    /**
     * @var IUserRepository
     */
    private $userRepository;

    /**
     * @var IPostRepository
     */
    private $postRepository;

    /**
     * @param IFavoriteRepository $favoriteRepository
     * @param IHistoryService $historyService
     * @param IUserRepository $userRepository
     * @param IPostRepository $postRepository
     */
    function __construct(IFavoriteRepository $favoriteRepository, IHistoryService $historyService, IUserRepository $userRepository, IPostRepository $postRepository)
    {
        $this->favoriteRepository = $favoriteRepository;
        $this->historyService = $historyService;
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function addFavorite(array $data)
    {
        if ($this->userRepository->get($data['user_id'])){
            $favorite = $this->favoriteRepository->create(array(
                'user_id' => $data['user_id'],
                'post_id' => $data['post_id']
            ));
            $this->historyService->create(array(
                'user_id' => $data['user_id'],
                'type_action' => 'favorite',
                'action_id' => $data['post_id']
            ));
            return $favorite;
        }
    }

    /**
     * @param $user_id
     * @param $post_id
     */
    public function unFavorite($user_id, $post_id)
    {
        if ($this->userRepository->get($user_id) && $this->postRepository->get($post_id)) {
            $this->favoriteRepository->getRecent()
                ->where('user_id', $user_id)
                ->where('post_id', $post_id)
                ->first()->delete();
        }
    }

    /**
     * @param $post_id
     * @return mixed
     */
    public function getUserFavorite($post_id)
    {
        $favorite = $this->favoriteRepository->getWhere('post_id', $post_id)->get();

        return $favorite;
    }

    /**
     * @param $post_id
     * @return bool
     */
    public function deleteFavoriteInPost($post_id)
    {
        $this->favoriteRepository->getWhere('post_id', $post_id)->delete();
        return true;
    }

}