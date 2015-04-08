<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 30/03/2015
 * Time: 22:17
 */

class CommentEventHandler {
    CONST EVENT = 'realTime.comment';
    CONST CHANNEL = 'realTime.comment';

    public function handle($data)
    {
        $redis = Redis::connection();
        $redis->publish(self::CHANNEL, $data);
    }
}