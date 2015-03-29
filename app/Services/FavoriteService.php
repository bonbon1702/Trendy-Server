<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/26/2015
 * Time: 7:34 PM
 */

namespace Services;


use Repositories\interfaces\IFavoriteRepository;
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
     * @param IFavoriteRepository $favoriteRepository
     * @param IHistoryService $historyService
     */
    function __construct(IFavoriteRepository $favoriteRepository, IHistoryService $historyService)
    {
        $this->favoriteRepository = $favoriteRepository;
        $this->historyService = $historyService;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
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

    /**
     * @param $user_id
     * @param $post_id
     */
    public function unFavorite($user_id, $post_id){
        $this->favoriteRepository->getRecent()
            ->where('user_id', $user_id)
            ->where('post_id', $post_id)
            ->first()->delete();
    }

    /**
     * @param $post_id
     * @return mixed
     */
    public function getUserFavorite($post_id){
        $favorite = $this->favoriteRepository->getWhere('post_id', $post_id)->get();

        return $favorite;
    }

}