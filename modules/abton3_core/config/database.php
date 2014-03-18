<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'cms_table_prefix' => 'a3_',
	'default' => array(
		'type' => 'MySQL',
		'connection' => array(
			'hostname' => 'localhost',
			'database' => 'abton3',
			'username' => 'root',
			'password' => 'root',
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