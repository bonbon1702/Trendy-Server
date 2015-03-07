<?php
/**
 * Created by PhpStorm.
 * User: Anh
 * Date: 1/20/2015
 * Time: 4:14 PM
 */

use Repositories\NotificationRepository;
use Services\NotificationService;
use Services\NotificationWatchedService;

class NotificationController extends \BaseController {


    public function __construct(NotificationService $notificationService, NotificationRepository $notificationRepository, NotificationWatchedService $notificationWatchedService) {
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