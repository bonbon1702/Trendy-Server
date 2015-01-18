<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/14/2015
 * Time: 8:54 PM
 */

namespace Services;


use Core\BaseService;
use Repositories\UploadRepository;

class UploadService implements BaseService{

    private $uploadRepository;

    function __construct(UploadRepository $uploadRepository)
    {
        // TODO: Implement __construct() method.
        $this->uploadRepository = $uploadRepository;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        $upload = $this->uploadRepository->create($data);

        return true;
    }

    public function update($model, array $data)
    {
        // TODO: Implement update() method.
        $upload = $this->uploadRepository->update($model,$data);

        return true;
    }

    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
    }

}