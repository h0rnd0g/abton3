<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'cms_table_prefix' => 'a3_',
	'default' => array(
		'type' => 'MySQL',
		'connection' => array(
			'hostname' => 'localhost',
			'database' => 'invacare_site',
			'username' => 'u_invacare',
			'password' => 'i123456',
			'persistent' => false,
		),
		'table_prefix' => '',
		'charset' => 'utf8',
		'caching' => false,
	),
	'default.hostname' => 'localhost',
	'default.database' => 'abton3',
	'default.username' => 'root',
	'default.password' => 'root',
);