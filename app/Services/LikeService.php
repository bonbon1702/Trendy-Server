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

class LikeService implements BaseService
{

    private $likeRepository;

    private $userRepository;

    private $historyService;

    function __construct(LikeRepository $likeRepository, UserRepository $userRepository, HistoryService $historyService)
    {
        $this->likeRepository = $likeRepository;
        $this->userRepository = $userRepository;
        $this->historyService = $historyService;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.

    }

    public function update(array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
    }

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

    public function countLike($type_like, $type_id){
        $count = $this->likeRepository->getLike($type_like, $type_id)->get();

        return $count;
    }

}