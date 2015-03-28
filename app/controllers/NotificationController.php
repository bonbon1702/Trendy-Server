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

class NotificationController extends \BaseController {

    private $notificationService;

    private $notificationRepository;

    private $notificationWatchedService;

    public function __construct(INotificationService $notificationService, INotificationRepository $notificationRepository, INotificationWatchedService $notificationWatchedService) {
        $this->notificationService = $notificationService;
        $this->notificationRepository = $notificationRepository;
        $this->notificationWatchedService = $notificationWatchedService;
    }

    public function index() {

    }

    public function store() {

    }

    public function update($id) {

    }

    public function destroy($id) {

    }

    /**
     * Display the specified resource.
     * GET /notification/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $notification = $this->notificationService->getNotification($id);

        return Response::json(array(
            'success' => true,
            'notification' => $notification
        ));
    }

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