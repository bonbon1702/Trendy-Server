<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 3/3/15
 * Time: 9:06 PM
 */

namespace Services;

use Repositories\interfaces\INotificationWatchedRepository;
use Services\interfaces\INotificationWatchedService;

/**
 * Class NotificationWatchedService
 * @package Services
 */
class NotificationWatchedService implements INotificationWatchedService{

    /**
     * @var INotificationWatchedRepository
     */
    private $notificationWatchedRepository;

    /**
     * @param INotificationWatchedRepository $notificationWatchedRepository
     */
    function __construct(INotificationWatchedRepository $notificationWatchedRepository)
    {
        $this->notificationWatchedRepository = $notificationWatchedRepository;
    }

    /**
     * @param array $data
     * @return bool
     */
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

} 