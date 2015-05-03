<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/14/2015
 * Time: 8:54 PM
 */

namespace Services;

use Core\Helper;
use Repositories\interfaces\IUploadRepository;
use Repositories\interfaces\IUserRepository;
use \Image;
use Services\interfaces\IUploadService;

/**
 * Class UploadService
 * @package Services
 */
class UploadService implements IUploadService{

    /**
     * @var UploadRepository
     */
    private $uploadRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;


    /**
     * @param IUploadRepository $uploadRepository
     * @param IUserRepository $userRepository
     */
    function __construct(IUploadRepository $uploadRepository, IUserRepository $userRepository)
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
            $image = Image::make($img);
            $image_name = date('Y') . '_' . date('m') . '_' .date('d'). '_' . Helper::get_rand_alphanumeric(8);
            $image_url = 'assets/images/'.$image_name.'.jpg';

            $image->save($image_url);
//            $upload = $this->uploadRepository->create(array(
//                'image_url' => url() . '/' . $image_url,
//                'name' => $image_name
//            ));
            $upload = $this->uploadRepository->create(array(
                'image_url' => 'http://103.7.40.222' . '/' . $image_url,
                'name' => $image_name
            ));
//            \Cloudy::upload($img, $image_name);
//            $upload = $this->uploadRepository->create(array(
//                'image_url' => 'http://res.cloudinary.com/danpj76kz/image/upload/' . $image_name,
//                'name' => $image_name
//            ));
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
     * @param $name
     * @return mixed
     */
    public function getUploadImage($name){
        $upload = $this->uploadRepository->getWhere('name', $name);

        return $upload;
    }

}