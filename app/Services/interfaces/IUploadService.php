<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 27/03/2015
 * Time: 21:38
 */

namespace Services\interfaces;


/**
 * Interface IUploadService
 * @package Services\interfaces
 */
interface IUploadService
{

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function update(array $data);

    /**
     * @param $name
     * @return mixed
     */
    public function getUploadImage($name);

}