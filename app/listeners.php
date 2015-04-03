<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 18/03/2015
 * Time: 16:41
 */
Event::listen(UpdateScoreEventHandler::EVENT, 'UpdateScoreEventHandler');
Event::listen(NotificationEventHandler::EVENT, 'NotificationEventHandler');
Event::listen(CommentEventHandler::EVENT, 'CommentEventHandler');
