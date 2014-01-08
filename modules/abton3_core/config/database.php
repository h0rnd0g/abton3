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
//            'hostname'   => 'localhost',
//            'database'   => 'demo19_site',
//            'username'   => 'u_biznes',
//            'password'   => 'b123456',
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
