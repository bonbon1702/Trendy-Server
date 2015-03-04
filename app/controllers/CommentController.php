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

/**
 * Class CommentController
 */
class CommentController extends \BaseController {

    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * @var PostService
     */
    private $postService;

    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @var CommentService
     */
    private $commentService;

    /**
     * @var ShopRepository
     */
    private $shopRepository;

    /**
     * @var ShopService
     */
    private $shopService;

    /**
     * @param PostRepository $postRepository
     * @param CommentRepository $commentRepository
     * @param PostService $postService
     * @param CommentService $commentService
     * @param ShopRepository $shopRepository
     * @param ShopService $shopService
     */
    public function __construct(PostRepository $postRepository, CommentRepository $commentRepository, PostService $postService, CommentService $commentService, ShopRepository $shopRepository, ShopService $shopService) {
        $this->commentRepository = $commentRepository;
        $this->commentService = $commentService;
        $this->postRepository = $postRepository;
        $this->postService = $postService;
        $this->shopRepository = $shopRepository;
        $this->shopService = $shopService;
    }

    /**
     * @return mixed
     */
    public function index() {
        $comment = $this->commentRepository->all();
        return Response::json(array(
            'success' => true,
            'comment' => $comment
        ));
    }

    /**
     * @return mixed
     */
    public function store() {
        $data = Input::all();

        $comment = $this->commentService->create($data);

        return Response::json(array(
            'success' => true,
            'comment' => $comment
        ));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function update($id) {
        $data = Input::all();
        $data['id'] = $id;
        $this->commentService->update($data);

        return Response::json(array(
            'success' => true
        ));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id) {
        $this->commentService->deleteComment($id);
        return Response::json(array(
            'success' => true,
        ));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function showPost($id) {
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
    public function showShop($id) {
        $comment = $this->commentService->showCommentByShopId($id);

        return Response::json(array(
            'success' => true,
            'comment' => $comment
        ));
    }
}