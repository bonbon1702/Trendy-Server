<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/14/2015
 * Time: 8:54 PM
 */

namespace Services;


use Core\BaseService;
use Core\Helper;
use Repositories\UploadRepository;
use Repositories\UserRepository;
use \Image;

class UploadService implements BaseService{

    private $uploadRepository;

    private $userRepository;

    function __construct(UploadRepository $uploadRepository, UserRepository $userRepository)
    {
        // TODO: Implement __construct() method.
        $this->uploadRepository = $uploadRepository;
        $this->userRepository = $userRepository;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        $user = $this->userRepository->getRecent();
        $img = $data['img'];
        if ($user && $img){
//            $image = Image::make($img);
            $image_name = Helper::get_rand_alphanumeric(8);
//            $image_url = 'assets/images/' .$image_name.'.jpg';
//
//            $image->save($image_url);
            \Cloudy::upload($img, $image_name);
            $upload = $this->uploadRepository->create(array(
                'user_id' => $user->id,
                'image_url' => 'http://res.cloudinary.com/danpj76kz/image/upload/' . $image_name,
                'name' => $image_name
            ));
        }
        return $upload;
    }

    public function update(array $data)
    {
        // TODO: Implement update() method.
        $img = Image::make($data['img']);
        $image_name_editor = Helper::get_rand_alphanumeric(8);
        $image_url = 'assets/images/' .$image_name_editor . '.jpg';

        $img->save($image_url);
        $upload = $this->uploadRepository->update('name', $data['name'], array(
            'image_url_editor' => url() . '/' . $image_url
        ));

        return $upload;
    }

    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
    }

    public function getUploadImage($name){
        $upload = $this->uploadRepository->getWhere('name', $name);

        return $upload;
    }

}