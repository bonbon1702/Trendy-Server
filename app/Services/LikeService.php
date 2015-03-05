<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/26/2015
 * Time: 7:32 PM
 */

namespace Services;


use Core\BaseService;
use Repositories\LikeRepository;
use Repositories\UserRepository;

/**
 * Class LikeService
 * @package Services
 */
class LikeService implements BaseService
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
     * @param LikeRepository $likeRepository
     * @param UserRepository $userRepository
     * @param HistoryService $historyService
     */
    function __construct(LikeRepository $likeRepository, UserRepository $userRepository, HistoryService $historyService)
    {
        $this->likeRepository = $likeRepository;
        $this->userRepository = $userRepository;
        $this->historyService = $historyService;
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.

    }

    /**
     * @param array $data
     */
    public function update(array $data)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $column
     * @param $value
     */
    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
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
            if ($type_like = 0) {
                $notification = $this->notificationService->create(array(
                    'type_id' => $type_id,
                    'user_id' => $user_id
                ));
                Pusherer::trigger('notification', 'like', array('notification' => $notification));
            }
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

}