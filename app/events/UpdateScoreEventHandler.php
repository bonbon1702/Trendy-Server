<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 18/03/2015
 * Time: 16:40
 */

class UpdateScoreEventHandler {
    CONST EVENT = 'score.update';
    CONST CHANNEL = 'score.update';

    public function handle($data)
    {
        $redis = Redis::connection();
        $redis->publish(self::CHANNEL, $data);
    }
}