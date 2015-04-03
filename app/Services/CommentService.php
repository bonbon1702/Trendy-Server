<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:31 AM
 */

namespace Services;

use Repositories\interfaces\ICommentRepository;
use Repositories\interfaces\IUserRepository;
use Repositories\interfaces\IPostRepository;
use Repositories\interfaces\IShopRepository;
use Services\interfaces\ICommentService;
use Services\interfaces\IHistoryService;

/**
 * Class CommentService
 * @package Services
 */
class CommentService implements ICommentService{

    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * @var ShopRepository
     */
    private $shopRepository;

    /**
     * @var HistoryService
     */
    private $historyService;


    /**
     * @param ICommentRepository $commentRepository
     * @param IUserRepository $userRepository
     * @param IPostRepository $postRepository
     * @param IShopRepository $shopRepository
     * @param IHistoryService $historyService
     */
    function __construct(ICommentRepository $commentRepository, IUserRepository $userRepository, IPostRepository $postRepository, IShopRepository $shopRepository, IHistoryService $historyService)
    {
        // TODO: Implement __construct() method.
        $this->commentRepository = $commentRepository;
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
        $this->shopRepository = $shopRepository;
        $this->historyService = $historyService;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        $content = $data['content'];
        $type_comment = $data['type_comment'];
        $type_id = $data['type_id'];
        $user_id = $data['user_id'];
        $comment = $this->commentRepository->create(array(
            'user_id' => $user_id,
            'type_comment' => $type_comment,
            'type_id' => $type_id,
            'content' => $content,
        ));
        $comment['user'] = $comment->user;
        $this->historyService->create(array(
            'user_id' => $user_id,
            'type_action' => 'comment',
            'action_id' => $type_id
        ));
        return $comment;
    }

    /**
     * @param array $data
     */
    public function update(array $data)
    {
        // TODO: Implement update() method.
        $this->commentRepository->update('id', $data['id'], $data);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function showCommentByPostId($id){
        $comment = $this->commentRepository->whereTypeComment(0,$id);
        foreach ($comment as $v){
            $v['user'] = $v->user;
        }
        return $comment;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function showCommentByShopId($id){
        $comment = $this->commentRepository->whereTypeComment(1,$id);
        foreach ($comment as $v){
            $v['user'] = $v->user;
        }
        return $comment;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteCommentInPost($id){
        return $this->commentRepository->deleteCommentInPost($id);
    }

    public function editPostComment($id, $content){
        $this->commentRepository->getRecent()
            ->where('id', $id)->where('type_comment', 0)
            ->update(array(
                'content' => $content
            ));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteCommentInShop($id){
        return $this->commentRepository->getRecent()
            ->where('type_comment', 1)->where('id', $id)->delete();
    }

    /**
     * @param $id
     * @param $content
     * @return mixed
     */
    public function editShopComment($id, $content){
        $this->commentRepository->getRecent()
            ->where('id', $id)->where('type_comment', 1)
            ->update(array(
                'content' => $content
            ));
    }
}