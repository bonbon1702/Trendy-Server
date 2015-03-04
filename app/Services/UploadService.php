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

/**
 * Class UploadService
 * @package Services
 */
class UploadService implements BaseService{

    /**
     * @var UploadRepository
     */
    private $uploadRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param UploadRepository $uploadRepository
     * @param UserRepository $userRepository
     */
    function __construct(UploadRepository $uploadRepository, UserRepository $userRepository)
    {
        // TODO: Implement __construct() method.
        $this->uploadRepository = $uploadRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        $img = $data['img'];
        if ($img){
//            $image = Image::make($img);
            $image_name = Helper::get_rand_alphanumeric(8);
//            $image_url = 'assets/images/' .$image_name.'.jpg';
//
//            $image->save($image_url);
            \Cloudy::upload($img, $image_name);
            $upload = $this->uploadRepository->create(array(
                'image_url' => 'http://res.cloudinary.com/danpj76kz/image/upload/' . $image_name,
                'name' => $image_name
            ));
        }
        return $upload;
    }

    /**
     * @param array $data
     * @return mixed
     */
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

    /**
     * @param $column
     * @param $value
     */
    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getUploadImage($name){
        $upload = $this->uploadRepository->getWhere('name', $name);

        return $upload;
    }

}