<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 3/3/15
 * Time: 9:03 PM
 */

namespace Repositories;

use NotificationWatched;
use Repositories\interfaces\INotificationWatchedRepository;

class NotificationWatchedRepository implements INotificationWatchedRepository
{

    public function all(array $related = null)
    {
        // TODO: Implement all() method.
    }

    public function get($id, array $related = null)
    {
        // TODO: Implement get() method.
        $notification_watch = NotificationWatched::find($id);

        return $notification_watch;
    }

    public function getWhere($column, $value, array $related = null)
    {
        // TODO: Implement getWhere() method.
        $notification_watch = NotificationWatched::where($column, $value);

        return $notification_watch;
    }

    public function getRecent(array $related = null)
    {
        // TODO: Implement getRecent() method.
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        if (!empty($data)) {
            $notification_watched = NotificationWatched::create($data);
        }

        return $notification_watched;
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