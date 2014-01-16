<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'installed' => true,
	'hash_method' => 'sha1',
	'hash_length' => 40,
	'use_salt' => true,
	'salt_length' => 8,
	'salt_characters' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?',
	'cookie_expiration' => 604800,
	'cookie_expiration_short' => 3600,
);