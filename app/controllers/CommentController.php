<?php
/**
 * Created by PhpStorm.
 * User: Anh
 * Date: 1/20/2015
 * Time: 4:14 PM
 */

use Repositories\CommentRepository;
use Services\CommentService;
use Repositories\PostRepository;
use Services\PostService;
use Repositories\ShopRepository;
use Services\ShopService;
use Services\NotificationService;
use Repositories\UserRepository;

class CommentController extends \BaseController {

    private $postRepository;

    private $postService;

    private $commentRepository;

    private $commentService;

    private $shopRepository;

    private $shopService;

    private $notificationService;

    private $userRepository;

    public function __construct(PostRepository $postRepository, CommentRepository $commentRepository, PostService $postService, CommentService $commentService, ShopRepository $shopRepository, ShopService $shopService, NotificationService $notificationService, UserRepository $userRepository) {
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