<?php
/**
 * Created by PhpStorm.
 * User: Anh
 * Date: 1/20/2015
 * Time: 4:14 PM
 */

use Repositories\interfaces\ICommentRepository;
use Services\interfaces\ICommentService;
use Repositories\interfaces\IPostRepository;
use Services\interfaces\IPostService;
use Repositories\interfaces\IShopRepository;
use Services\interfaces\IShopService;
use Services\interfaces\INotificationService;
use Repositories\interfaces\IUserRepository;

class CommentController extends \BaseController {

    private $postRepository;

    private $postService;

    private $commentRepository;

    private $commentService;

    private $shopRepository;

    private $shopService;

    private $notificationService;

    private $userRepository;

    public function __construct(IPostRepository $postRepository, ICommentRepository $commentRepository, IPostService $postService, ICommentService $commentService, IShopRepository $shopRepository, IShopService $shopService, INotificationService $notificationService, IUserRepository $userRepository) {
        $this->commentRepository = $commentRepository;
        $this->commentService = $commentService;
        $this->postRepository = $postRepository;
        $this->postService = $postService;
        $this->shopRepository = $shopRepository;
        $this->shopService = $shopService;
        $this->notificationService = $notificationService;
        $this->userRepository = $userRepository;
    }

    public function index() {
        $comment = $this->commentRepository->all();
        return Response::json(array(
            'success' => true,
            'comment' => $comment
        ));
    }

    public function store() {
        $data = Input::all();

        $comment = $this->commentService->create($data);

        $data['action'] = 'comment';

        $notification = $this->notificationService->create($data);
        $notification['username'] = $this->userRepository->get($notification->user_id)->username;
        $notification['list_user'] =  $this->notificationService->userEffectedPost($notification->post_id);

        Event::fire(NotificationEventHandler::EVENT, array(
            'notification' => $notification,
        ));

        return Response::json(array(
            'success' => true,
            'comment' => $comment
        ));
    }

    public function update($id) {
        $data = Input::all();
        $data['id'] = $id;
        $this->commentService->update($data);

        return Response::json(array(
            'success' => true
        ));
    }

    public function destroy($id) {
        $this->commentService->deleteComment($id);
        return Response::json(array(
            'success' => true,
        ));
    }

    public function showPost($id) {
        $comment = $this->commentService->showCommentByPostId($id);
        return Response::json(array(
            'success' => true,
            'comment' => $comment
        ));
    }

    public function showShop($id) {
        $comment = $this->commentService->showCommentByShopId($id);

        return Response::json(array(
            'success' => true,
            'comment' => $comment
        ));
    }
}