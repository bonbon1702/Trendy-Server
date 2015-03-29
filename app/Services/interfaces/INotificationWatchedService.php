<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 27/03/2015
 * Time: 21:35
 */

namespace Services\interfaces;


interface INotificationWatchedService {
    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data);
}