<?php
/**
 * Created by PhpStorm.
 * User: Anh
 * Date: 1/20/2015
 * Time: 4:14 PM
 */

use Repositories\NotificationRepository;
use Services\NotificationService;

class NotificationController extends \BaseController {


    public function __construct(NotificationService $notificationService, NotificationRepository $notificationRepository) {
        $this->notificationService = $notificationService;
        $this->notificationRepository = $notificationRepository;
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

    }
}