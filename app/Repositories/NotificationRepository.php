<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 3/3/15
 * Time: 9:03 PM
 */

namespace Repositories;


use Notification;
use Repositories\interfaces\INotificationRepository;

class NotificationRepository implements INotificationRepository
{

    public function all(array $related = null)
    {
        // TODO: Implement all() method.
    }

    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
    }

    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
        $notification = Notification::where($column, $value);

        return $notification;
    }

    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
        $notification = new Notification();

        return $notification;
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)) {
            $notification = Notification::create($data);
        }

        return $notification;
    }

    public function update($column, $value, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function deleteWhere($column, $value)
    {
        // TODO: Implement deleteWhere() method.
    }

} 