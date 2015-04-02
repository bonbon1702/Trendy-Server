<?php
/**
 * Created by PhpStorm.
 * User: Anh
 * Date: 1/20/2015
 * Time: 4:14 PM
 */

use Repositories\interfaces\ICommentRepository;
use Repositories\interfaces\IPostRepository;
use Repositories\interfaces\IShopRepository;
use Repositories\interfaces\IUserRepository;
use Services\interfaces\ICommentService;
use Services\interfaces\INotificationService;
use Services\interfaces\IPostService;
use Services\interfaces\IShopService;

/**
 * Class CommentController
 */
class CommentController extends \BaseController
{

    /**
     * @var IPostRepository
     */
    private $postRepository;

    /**
     * @var IPostService
     */
    private $postService;

    /**
     * @var ICommentRepository
     */
    private $commentRepository;

    /**
     * @var ICommentService
     */
    private $commentService;

    /**
     * @var IShopRepository
     */
    private $shopRepository;

    /**
     * @var IShopService
     */
    private $shopService;

    /**
     * @var INotificationService
     */
    private $notificationService;

    /**
     * @var IUserRepository
     */
    private $userRepository;

    /**
     * @param IPostRepository $postRepository
     * @param ICommentRepository $commentRepository
     * @param IPostService $postService
     * @param ICommentService $commentService
     * @param IShopRepository $shopRepository
     * @param IShopService $shopService
     * @param INotificationService $notificationService
     * @param IUserRepository $userRepository
     */
    public function __construct(IPostRepository $postRepository, ICommentRepository $commentRepository, IPostService $postService, ICommentService $commentService, IShopRepository $shopRepository, IShopService $shopService, INotificationService $notificationService, IUserRepository $userRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->commentService = $commentService;
        $this->postRepository = $postRepository;
        $this->postService = $postService;
        $this->shopRepository = $shopRepository;
        $this->shopService = $shopService;
        $this->notificationService = $notificationService;
        $this->userRepository = $userRepository;
    }

    /**
     * @return mixed
     */
    public function saveComment()
    {
        $data = Input::all();

        $comment = $this->commentService->create($data);

        $data['action'] = 'comment';

        $notification = $this->notificationService->create($data);
        $notification['username'] = $this->userRepository->get($notification->user_id)->username;
        $notification['list_user'] = $this->notificationService->userEffectedPost($notification->post_id);


        Event::fire(NotificationEventHandler::EVENT, array(
            'notification' => $notification,
        ));

        Event::fire(CommentEventHandler::EVENT, array(
            'comment' => $comment
        ));

        return Response::json(array(
            'success' => true,
            'comment' => $comment
        ));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function showPost($id)
    {
        $comment = $this->commentService->showCommentByPostId($id);
        return Response::json(array(
            'success' => true,
            'comment' => $comment
        ));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function showShop($id)
    {
        $comment = $this->commentService->showCommentByShopId($id);

        return Response::json(array(
            'success' => true,
            'comment' => $comment
        ));
    }

    public function editPostComment($id, $content){
        $this->commentService->editPostComment($id, $content);

        return Response::json(array(
            'success' => true
        ));
    }

    public function deletePostComment($id){
        $comment = $this->commentService->deleteCommentInPost($id);
        return Response::json(array(
            'success' => true
        ));
    }
}