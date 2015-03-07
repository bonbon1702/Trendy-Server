<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 3/3/15
 * Time: 9:06 PM
 */

namespace Services;


use Core\BaseService;
use Repositories\NotificationWatchedRepository;

class NotificationWatchedService implements BaseService{

    private $notificationWatchedRepository;

    function __construct(NotificationWatchedRepository $notificationWatchedRepository)
    {
        $this->notificationWatchedRepository = $notificationWatchedRepository;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        $check = $this->notificationWatchedRepository->getWhere('notification_id', $data['notification_id'])->get();

        if (count($check) == 0) {
            $notification_watched = $this->notificationWatchedRepository->create(array(
                'user_id' => $data['user_id'],
                'notification_id' => $data['notification_id']
            ));
        }

        return true;
    }

    public function update(array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
    }
} 