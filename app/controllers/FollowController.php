<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 20/1/2015
 * Time: 10:19 AM
 */

use Repositories\FollowRepository;
use Services\FollowService;

class FollowController extends \BaseController{

    private $followService;
    private $followRepository;

    public function __construct(FollowService $followService,FollowRepository $followRepository){
        $this->followService=$followService;
        $this->followRepository=$followRepository;
    }


    /**
     * Display all following by user
     * GET/following
     * @return Response
     */
    public function FollowingByUser(){
        $follow=$this->followService->FollowingByUser();

        return Response::json(array(
            'success'=>'true',
            'follow'=>$follow
        ));
    }

    /**
     * Display all follower by user
     *
     * GET/follower
     * @return Response
     */
    public function FollowerByUser(){
        $follow=$this->followService->FollowerByUser();

        return Response::json(array(
            'success'=>'true',
            'follow'=>$follow
        ));
    }
    /**
     * Display all follow
     * POST/follow
     *
     * @return Response
     */
    public function  store(){
        $data=Input::all();
        $this->followService->create($data);
        return Response::json(array(
            'success'=>true
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
        $data=Input::all();
        $data['id'] = $id;
        $this->followService->update($data);
        return Response::json(array(
            'success'=>true
        ));
    }


    /**
     * Remove the specified Follow from storage.
     * DELETE/follow
     *
     * @return Response
     */
    public function destroy($id)
    {
        $data=Input::all();
        $this->followService->delete('id',$id);
        return Response::json(array(
            'success' => true
        ));
    }
} 