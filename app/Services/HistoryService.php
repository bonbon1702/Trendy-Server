<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 2/8/15
 * Time: 2:29 PM
 */

namespace Services;


use Core\BaseService;
use Repositories\HistoryRepository;

class HistoryService implements BaseService{

    private $historyRepository;

    function __construct(HistoryRepository $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        $history = $this->historyRepository->create($data);

        return true;
    }

    public function update(array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
    }

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