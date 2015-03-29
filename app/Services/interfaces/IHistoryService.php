<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 27/03/2015
 * Time: 21:34
 */

namespace Services\interfaces;


/**
 * Interface IHistoryService
 * @package Services\interfaces
 */
interface IHistoryService
{
    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data);


    /**
     * @param $type_action
     * @param $action_id
     * @param $start
     * @param $end
     * @return mixed
     */
    public function actionCount($type_action, $action_id, $start, $end);
}