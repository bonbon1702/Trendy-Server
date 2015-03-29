<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 27/03/2015
 * Time: 21:37
 */

namespace Services\interfaces;


/**
 * Interface ITagPictureService
 * @package Services\interfaces
 */
interface ITagPictureService
{
    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data);


    /**
     * @param $id
     * @param $offSet
     * @return mixed
     */
    public function getPagingPostInShopByShopId($id, $offSet);

    /**
     * @param $id
     * @return mixed
     */
    public function getPostInShopByShopId($id);
}