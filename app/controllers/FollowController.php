<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 20/1/2015
 * Time: 10:19 AM
 */

use Repositories\FollowRepository;
use Services\FollowService;

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
     * @param FollowService $followService
     * @param FollowRepository $followRepository
     */
    public function __construct(FollowService $followService, FollowRepository $followRepository)
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
     * Display all follow
     * POST/follow
     *
     * @return Response
     */
    public function  store()
    {
        $data = Input::all();

        $this->followService->create($data);
        return Response::json(array(
            'success' => true
        ));
    }

    /**
     * Update the specified resource in storage.
     * PUT/follow
     *
     * @return Response
     */
    public function update($id)
    {
        $data = Input::all();
        $data['id'] = $id;
        $this->followService->update($data);
        return Response::json(array(
            'success' => true
        ));
    }


    /**
     * Remove the specified Follow from storage.
     * DELETE/follow
     *
     * @return Response
     */
    public function deleteFollowing()
    {
        $data = Input::all();
        $this->followService->deleteFollowing($data);
        return Response::json(array(
            'success' => true
        ));
    }
} 