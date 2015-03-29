<?php
/**
 * Created by PhpStorm.
 * User: Anh
 * Date: 1/20/2015
 * Time: 4:14 PM
 */

use Services\interfaces\INotificationService;
use Services\interfaces\IFavoriteService;
use Repositories\interfaces\IUserRepository;

/**
 * Class FavoriteController
 */
class FavoriteController extends \BaseController
{

    /**
     * @var INotificationService
     */
    private $notificationService;

    /**
     * @var IFavoriteService
     */
    private $favoriteService;

    /**
     * @var IUserRepository
     */
    private $userRepository;

    /**
     * @param INotificationService $notificationService
     * @param IFavoriteService $favoriteService
     * @param IUserRepository $userRepository
     */
    public function __construct(INotificationService $notificationService, IFavoriteService $favoriteService, IUserRepository $userRepository)
    {
        $this->notificationService = $notificationService;
        $this->favoriteService = $favoriteService;
        $this->userRepository = $userRepository;
    }

    /**
     * @param $user_id
     * @param $post_id
     * @param $type
     * @return mixed
     */
    public function favoritePost($user_id, $post_id, $type)
    {
        if ($type == 'favorite') {
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
            $notification['username'] = $this->userRepository->get($notification->user_id)->username;
            $notification['list_user'] = $this->notificationService->userEffectedPost($notification->post_id);

            Event::fire(NotificationEventHandler::EVENT, array(
                'notification' => $notification
            ));
        } elseif ($type == 'unFavorite') {
            $this->favoriteService->unFavorite($user_id, $post_id);
        }

        return Response::json(array(
            'success' => true
        ));
    }
}