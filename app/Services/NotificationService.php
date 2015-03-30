<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 3/3/15
 * Time: 9:05 PM
 */

namespace Services;

use Repositories\interfaces\INotificationRepository;
use Repositories\interfaces\INotificationWatchedRepository;
use Repositories\interfaces\IUserRepository;
use Services\interfaces\IPostService;
use Services\interfaces\INotificationService;
use Services\interfaces\IShopService;
use Services\interfaces\IUserService;

/**
 * Class NotificationService
 * @package Services
 */
class NotificationService implements INotificationService
{


    /**
     * @param INotificationRepository $notificationRepository
     * @param IPostService $postService
     * @param IShopService $shopService
     * @param IUserService $userService
     * @param INotificationWatchedRepository $notificationWatchedRepository
     * @param IUserRepository $userRepository
     */
    function __construct(INotificationRepository $notificationRepository, IPostService $postService, IShopService $shopService, IUserService $userService, INotificationWatchedRepository $notificationWatchedRepository, IUserRepository $userRepository)
    {
        $this->notificationRepository = $notificationRepository;
        $this->postService = $postService;
        $this->shopService = $shopService;
        $this->userService = $userService;
        $this->notificationWatchedRepository = $notificationWatchedRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        $user_id = $this->postService->getPostDetails($data['type_id'])->user->id;

        $name_of_user_effected = \User::find($data['user_id'])->username;
        $avatar_of_user_effected = \User::find($data['user_id'])->picture_profile;
        $notification = $this->notificationRepository->create(array(
            'user_id' => $user_id,
            'id_of_user_effected' => $data['user_id'],
            'name_of_user_effected' => $name_of_user_effected,
            'avatar_of_user_effected' => $avatar_of_user_effected,
            'action' => $data['action'],
            'post_id' => $data['type_id']
        ));

        return $notification;
    }


    /**
     * @param $user_id
     * @return array
     */
    public function getNotification($user_id)
    {
        $notification_unread = array();

        $notification = $this->notificationRepository->getRecent()
            ->where('user_id', $user_id)
            ->having('id_of_user_effected', '<>', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();

        $notification_eff = $this->notificationRepository->getRecent()
            ->where('id_of_user_effected', $user_id)
            ->having('user_id', '<>', $user_id)
            ->groupBy('post_id')
            ->orderBy('created_at', 'desc')
            ->get();

        if (count($notification_eff) > 0){
            foreach ($notification_eff as $v) {
                $notification_effected = $this->notificationRepository->getRecent()
                    ->where('post_id', $v->post_id)
                    ->where('id_of_user_effected', '<>', $v->id_of_user_effected)
                    ->get();
            }

            foreach ($notification_effected as $v) {
                $notification[] = $v;
            }
        }

        if (count($notification) > 0) {
            foreach ($notification as $v) {
                $check = $this->notificationWatchedRepository->getWhere('notification_id', $v->id)->get();
                $v['username'] = $this->userRepository->get($v['user_id'])->username;
                if (count($check) == 0) {
                    $notification_unread[] = $v;
                }
            }

            foreach ($notification_unread as $v){
                $v['username'] = $this->userRepository->get($v['user_id'])->username;
            }
        }
        $results = array(
            'notification_unread' => $notification_unread,
            'notification' => $notification,
        );
        return $results;
    }

    /**
     * @param $post_id
     * @return mixed
     */
    public function userEffectedPost($post_id){
        $user_effected_id = $this->notificationRepository->getRecent()
            ->select('id_of_user_effected')
            ->where('post_id', $post_id)
            ->groupBy('id_of_user_effected')
            ->get();

        return $user_effected_id;
    }

} 