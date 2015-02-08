<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:31 AM
 */

namespace Services;


use Core\BaseService;
use Repositories\CommentRepository;
use Repositories\UserRepository;
use Repositories\PostRepository;
use Repositories\ShopRepository;

class CommentService implements BaseService{

    private $commentRepository;

    private $userRepository;

    private $postRepository;

    private $shopRepository;

    private $historyService;

    function __construct(CommentRepository $commentRepository, UserRepository $userRepository, PostRepository $postRepository, ShopRepository $shopRepository,HistoryService $historyService)
    {
        // TODO: Implement __construct() method.
        $this->commentRepository = $commentRepository;
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
        $this->shopRepository = $shopRepository;
        $this->historyService = $historyService;
    }
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

    public function update(array $data)
    {
        // TODO: Implement update() method.
        $this->commentRepository->update('id', $data['id'], $data);
    }

    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
    }

    public function deleteComment($id)
    {
        $this->commentRepository->delete($id);
        return true;
    }

    public function showCommentByPostId($id){
        $comment = $this->commentRepository->whereTypeComment(0,$id);
        foreach ($comment as $v){
            $v['user'] = $v->user;
        }
        return $comment;
    }

    public function showCommentByShopId($id){
        $comment = $this->commentRepository->whereTypeComment(1,$id);
        return $comment;
    }
}