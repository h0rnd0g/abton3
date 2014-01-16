<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'installed' => true,
	'hash_method' => 'md5',
	'hash_length' => 32,
	'use_salt' => false,
	'salt_length' => 0,
	'salt_characters' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?',
	'cookie_expiration' => 604800,
	'cookie_expiration_short' => 3600,
);