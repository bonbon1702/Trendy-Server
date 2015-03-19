<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 18/03/2015
 * Time: 17:02
 */

class NotificationEventHandler {
    CONST EVENT = 'realTime.notification';
    CONST CHANNEL = 'realTime.notification';

    public function handle($data)
    {
        $redis = Redis::connection();
        $redis->publish(self::CHANNEL, $data);
    }
}