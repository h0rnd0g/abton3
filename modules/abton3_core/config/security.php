<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'installed' => false,
	'hash_method' => 'sha512',
	'hash_length' => 128,
	'use_salt' => true,
	'salt_length' => 8,
	'salt_characters' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?',
	'cookie_expiration' => 604800,
	'cookie_expiration_short' => 3600,
);