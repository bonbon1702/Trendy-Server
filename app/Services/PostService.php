<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:33 AM
 */

namespace Services;


use Core\BaseService;
use Core\GoogleMapHelper;
use Repositories\PostRepository;
use Services\ShopService;
use Repositories\UploadRepository;
use Repositories\UserRepository;
use Services\TagPictureService;

class PostService implements BaseService{

    private $postRepository;

    private $userRepository;

    private $uploadRepository;

    private $tagPictureService;

    private $googleMapHelper;

    private $shopService;

    function __construct(PostRepository $postRepository,UserRepository $userRepository, UploadRepository $uploadRepository, TagPictureService $tagPictureService, GoogleMapHelper $googleMapHelper, ShopService $shopService)
    {
        // TODO: Implement __construct() method.
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
        $this->uploadRepository = $uploadRepository;
        $this->tagPictureService = $tagPictureService;
        $this->googleMapHelper = $googleMapHelper;
        $this->shopService = $shopService;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        $upload_id = $data['uploadId'];
        $caption =  $data['caption'];
        $points = $data['points'];
        $user_id = $this->userRepository->getRecent()->id;

        $upload = $this->uploadRepository->get($upload_id);

        $post = $this->postRepository->create(array(
            'user_id' => $user_id,
            'image_url' => $upload->image_url,
            'image_url_editor' => $upload->image_url_editor,
            'caption' => $caption,
        ));

        foreach ($points as $v){
            $result = $this->googleMapHelper->findCoordinate($v['address']);

            $shop = $this->shopService->checkCoordinates($result);


            $this->tagPictureService->create(array(
                'post_id' => $post->id,
                'name' => $v['name'],
                'price' => $v['price'],
                'top' => $v['top'],
                'left' => $v['left'],
                'shop_id' => $shop->id
            ));
        }
    }

    public function update($model, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
    }
}