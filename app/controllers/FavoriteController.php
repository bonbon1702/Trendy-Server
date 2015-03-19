<?php
/**
 * Created by PhpStorm.
 * User: Anh
 * Date: 1/20/2015
 * Time: 4:14 PM
 */

use Services\NotificationService;
use Services\FavoriteService;

class FavoriteController extends \BaseController {

    private $notificationService;

    private $favoriteService;

    public function __construct(NotificationService $notificationService, FavoriteService $favoriteService) {
        $this->notificationService = $notificationService;
        $this->favoriteService = $favoriteService;
    }

    public function index() {

    }

        public function store() {

        }

        public function update($id) {

        }

        public function destroy($id) {

        }

        public function favoritePost($user_id, $post_id, $type){
        if ($type == 'favorite'){
            $favorite = $this->favoriteService->create(array(
                'user_id' => $user_id,
                'post_id' => $post_id
            ));
            $data = array(
                'user_id' => $user_id,
                'type_id' => $post_id,
                'action' => 'favorite'
            );
            $notification = $this->notificationService->create($data);
            $user_effected_id =  $this->notificationService->userEffectedPost($notification->post_id);

            Event::fire(NotificationEventHandler::EVENT, array(
                'notification' => $notification,
                'user_effected_id' => $user_effected_id
            ));
        } elseif ($type == 'unFavorite'){
            $this->favoriteService->unFavorite($user_id,$post_id);
        }

        return Response::json(array(
            'success' => true
        ));
    }
}