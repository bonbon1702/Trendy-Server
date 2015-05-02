<?php
use Repositories\interfaces\IUserRepository;
use Services\interfaces\ILikeService;
use Services\interfaces\INotificationService;

/**
 * Class LikeController
 */
class LikeController extends \BaseController
{

    /**
     * @var LikeService
     */
    private $likeService;

    /**
     * @var INotificationService
     */
    private $notificationService;

    /**
     * @var IUserRepository
     */
    private $userRepository;


    /**
     * @param ILikeService $likeService
     * @param INotificationService $notificationService
     * @param IUserRepository $userRepository
     */
    function __construct(ILikeService $likeService, INotificationService $notificationService, IUserRepository $userRepository)
    {
        $this->likeService = $likeService;
        $this->notificationService = $notificationService;
        $this->userRepository = $userRepository;
    }

    /**
     * @return mixed
     */
    public function likePost()
    {
        $data = Input::all();
        $check = $this->userRepository->getRecent()
            ->where('remember_token', $data['token'])
            ->first();
        if ($check) {
            $id = $data['id'];
            $type = $data['type'];
            $user_id = $check->id;
            $this->likeService->likeOrDislike(0, $id, $type, $user_id);
            if ($type == 1) {
                $notification = $this->notificationService->create(array(
                    'type_id' => $id,
                    'user_id' => $user_id,
                    'action' => 'like'
                ));
                $notification['username'] = $this->userRepository->get($notification->user_id)->username;
                $notification['list_user'] = $this->notificationService->userEffectedPost($notification->post_id);

                Event::fire(NotificationEventHandler::EVENT, array(
                    'notification' => $notification,
                ));
            }
        }
        return Response::json(array(
            'success' => true
        ));
    }

    /**
     * @return mixed
     */
    public function likeShop()
    {
        $data = Input::all();
        $check = $this->userRepository->getRecent()
            ->where('remember_token', $data['token'])
            ->first();
        if ($check) {
            $id = $data['id'];
            $type = $data['type'];
            $user_id = $check->id;
            $this->likeService->likeOrDislike(1, $id, $type, $user_id);
        }
        return Response::json(array(
            'success' => true
        ));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function countLikePost($id)
    {
        $count = $this->likeService->countLike(0, $id);

        return Response::json(array(
            'success' => true,
            'like' => $count
        ));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function countLikeShop($id)
    {
        $count = $this->likeService->countLike(1, $id);

        return Response::json(array(
            'success' => true,
            'like' => $count
        ));
    }
}