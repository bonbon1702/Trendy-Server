<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 20/1/2015
 * Time: 10:19 AM
 */

use Repositories\interfaces\IFollowRepository;
use Services\interfaces\IFollowService;

/**
 * Class FollowController
 */
class FollowController extends \BaseController
{

    /**
     * @var FollowService
     */
    private $followService;
    /**
     * @var FollowRepository
     */
    private $followRepository;


    /**
     * @param IFollowService $followService
     * @param IFollowRepository $followRepository
     */
    public function __construct(IFollowService $followService, IFollowRepository $followRepository)
    {
        $this->followService = $followService;
        $this->followRepository = $followRepository;
    }


    /**
     * Display all following by user
     * GET/following
     * @return Response
     */
    public function followingByUser($id)
    {

        $follow = $this->followService->FollowingByUser($id);

        return Response::json(array(
            'success' => 'true',
            'follow' => $follow
        ));
    }

    /**
     * Display all follower by user
     *
     * GET/follower
     * @return Response
     */
    public function followerByUser($id)
    {
        $follow = $this->followService->FollowerByUser($id);

        return Response::json(array(
            'success' => 'true',
            'follow' => $follow
        ));
    }

    /**
     * @return mixed
     */
    public function addFollowing()
    {
        $data = Input::all();

        $this->followService->addFollowing($data);
        return Response::json(array(
            'success' => true
        ));
    }

    /**
     * @param $user_id
     * @param $follower_id
     * @return mixed
     */
    public function deleteFollowing($user_id, $follower_id)
    {
        $data = array(
            'user_id' => $user_id,
            'follower_id' => $follower_id
        );
        $this->followService->deleteFollowing($data);
        return Response::json(array(
            'success' => true
        ));
    }

    /**
     * @param $id
     * @param $type
     * @param $userId
     * @return mixed
     */
    public function suggestionFollow($id, $type, $userId)
    {
        $suggests = array();
        if ($type == 'popular') {
            $suggests = $this->followService->popularFollow($userId);
        } elseif ($type == 'itemToItem') {
            $suggests = $this->followService->itemToItemFollow($id, $userId);
        }


        return Response::json(array(
            'success' => true,
            'suggests' => $suggests
        ));
    }
} 