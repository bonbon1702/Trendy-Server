<?php

return array (
	'host'    => '127.0.0.1',
	'port'    => 9312,
	'indexes' => array (
		'shop_index' => array ( 'table' => 'shop', 'column' => 'id', 'modelname' => 'Shop' ),
        'user_index' => array ( 'table' => 'user', 'column' => 'id', 'modelname' => 'User' ),
	)
);
