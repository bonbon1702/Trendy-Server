<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 2/8/15
 * Time: 2:29 PM
 */

namespace Services;

use Repositories\interfaces\IHistoryRepository;
use Services\interfaces\IHistoryService;

/**
 * Class HistoryService
 * @package Services
 */
class HistoryService implements IHistoryService{

    /**
     * @var HistoryRepository
     */
    private $historyRepository;

    /**
     * @param HistoryRepository $historyRepository
     */
    function __construct(IHistoryRepository $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
        $history = $this->historyRepository->create($data);

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

    /**
     * @param $type_action
     * @param $action_id
     * @param $start
     * @param $end
     * @return mixed
     */
    public function actionCount($type_action, $action_id, $start, $end){
        $count = $this->historyRepository->getRecent()
                    ->where('type_action', $type_action)
                        ->where('action_id', $action_id)
                            ->where('created_at', '>', $start)
                                ->where('created_at', '<', $end)
                                    ->count();

        return $count;
    }

} 