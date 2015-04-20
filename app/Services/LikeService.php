<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/26/2015
 * Time: 7:32 PM
 */

namespace Services;

use Repositories\interfaces\ILikeRepository;
use Repositories\interfaces\IUserRepository;
use Services\interfaces\ILikeService;
use Services\interfaces\IHistoryService;

/**
 * Class LikeService
 * @package Services
 */
class LikeService implements ILikeService
{

    /**
     * @var LikeRepository
     */
    private $likeRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var HistoryService
     */
    private $historyService;


    /**
     * @param ILikeRepository $likeRepository
     * @param IUserRepository $userRepository
     * @param IHistoryService $historyService
     */
    function __construct(ILikeRepository $likeRepository, IUserRepository $userRepository, IHistoryService $historyService)
    {
        $this->likeRepository = $likeRepository;
        $this->userRepository = $userRepository;
        $this->historyService = $historyService;
    }


    /**
     * @param $type_like
     * @param $type_id
     * @param $type
     * @param $user_id
     * @return bool
     */
    public function likeOrDislike($type_like, $type_id, $type, $user_id){
        if ($type == 0){
            $this->likeRepository->getUserLike($user_id,$type_like, $type_id)->delete();
        } else {
            $this->likeRepository->create(array(
                'user_id' => $user_id,
                'type_like' => $type_like,
                'type_id' => $type_id
            ));
            $this->historyService->create(array(
                'user_id' => $user_id,
                'type_action' => 'like',
                'action_id' => $type_id
            ));
        }

        return true;
    }

    /**
     * @param $type_like
     * @param $type_id
     * @return mixed
     */
    public function countLike($type_like, $type_id){
        $count = $this->likeRepository->getLike($type_like, $type_id)->get();

        return $count;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteLikeInPost($id){
        return $this->likeRepository->deleteLikeInPost($id);
    }
}