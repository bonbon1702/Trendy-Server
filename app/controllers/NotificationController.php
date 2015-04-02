<?php
/**
 * Created by PhpStorm.
 * User: Anh
 * Date: 1/20/2015
 * Time: 4:14 PM
 */

use Repositories\interfaces\INotificationRepository;
use Services\interfaces\INotificationService;
use Services\interfaces\INotificationWatchedService;

/**
 * Class NotificationController
 */
class NotificationController extends \BaseController {

    /**
     * @var INotificationService
     */
    private $notificationService;

    /**
     * @var INotificationRepository
     */
    private $notificationRepository;

    /**
     * @var INotificationWatchedService
     */
    private $notificationWatchedService;

    /**
     * @param INotificationService $notificationService
     * @param INotificationRepository $notificationRepository
     * @param INotificationWatchedService $notificationWatchedService
     */
    public function __construct(INotificationService $notificationService, INotificationRepository $notificationRepository, INotificationWatchedService $notificationWatchedService) {
        $this->notificationService = $notificationService;
        $this->notificationRepository = $notificationRepository;
        $this->notificationWatchedService = $notificationWatchedService;
    }

    /**
     * Display the specified resource.
     * GET /notification/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function getNotificationByUserId($id)
    {
        $notification = $this->notificationService->getNotification($id);

        return Response::json(array(
            'success' => true,
            'notification' => $notification
        ));
    }

    /**
     * @return mixed
     */
    public function watchedNotification()
    {
        $data = Input::all();

        foreach ($data as $v){
            $this->notificationWatchedService->create($v);
        }

        return Response::json(array(
            'success' => true
        ));
    }
}