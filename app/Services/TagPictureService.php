<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:42 AM
 */

namespace Services;

use Repositories\interfaces\ITagPictureRepository;
use Services\interfaces\ITagPictureService;

/**
 * Class TagPictureService
 * @package Services
 */
class TagPictureService implements ITagPictureService{

    /**
     * @var TagPictureRepository
     */
    private $tagPictureRepository;

    /**
     * @param TagPictureRepository $tagPictureRepository
     */
    function __construct(ITagPictureRepository $tagPictureRepository)
    {
        $this->tagPictureRepository = $tagPictureRepository;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        $tagPicture = $this->tagPictureRepository->create($data);

        return true;
    }

    /**
     * @param array $data
     */
    public function update(array $data)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $column
     * @param $value
     */
    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
    }

    public function getPagingPostInShopByShopId($id,$offSet){
        return $this->tagPictureRepository->joinPostAndTagPicture()
                                            ->select('post_id', 'post.name', 'image_url_editor', 'caption', 'post.created_at', 'post.updated_at')
                                                ->where('shop_id','=',$id)
                                                    ->take(12)
                                                        ->skip($offSet)
                                                            ->get();
    }

    public function getPostInShopByShopId($id){
        return $this->tagPictureRepository->joinPostAndTagPicture()
                                            ->select('post_id', 'post.name', 'image_url_editor', 'caption', 'post.created_at', 'post.updated_at')
                                                ->where('shop_id','=',$id)
                                                    ->get();
    }
}
