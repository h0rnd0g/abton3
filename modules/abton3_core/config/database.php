<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
    // префикс таблиц системы управления
    'cms_table_prefix' => 'a3_',

    // конфигурация БД приложения
    'default' => array
    (
        'type'       => 'MySQL',
        'connection' => array(
            'hostname'   => 'localhost',
            'database'   => 'abton3',
            'username'   => 'root',
            'password'   => 'root',
            'persistent' => FALSE,
        ),
        'table_prefix' => '', // стандартный префикс для сайта
        'charset'      => 'utf8',
        'caching'      => FALSE,
    ),
);
