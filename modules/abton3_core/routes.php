<?php defined('SYSPATH') or die('No direct script access.');

// -- Описание усех роутов ядра системы управления Abton3 CMS ----------------------------

/*
 * Константы
 */
define('A3_ROOT_URL', Instance_Routing::get()->getRootUrl());

/*
 * Описание роутов
 */

    /*
     * роуты установщика системы управления
     */

        // главная страница установки
        Route::set('a3_core_install', '(<lng>/)'.A3_ROOT_URL.'/install')
            ->defaults(array(
                'controller' => 'install',
                'action'     => 'index',
            ));

        // проверка соединения с БД
        Route::set('a3_core_install_test', '(<lng>/)'.A3_ROOT_URL.'/install/connection_test')
            ->defaults(array(
                'controller' => 'install',
                'action'     => 'test',
            ));

// роут страницы авторизации (н-р, "/ua/admin/login", "/admin/login")
Route::set('a3_core_loginscreen', '(<lng>/)'.A3_ROOT_URL.'/login')
    ->defaults(array(
        'controller' => 'login',
        'action'     => 'index',
    ));

    /*
     * роуты страниц личного кабинета пользователя
     */

        // роут страницы редактирование информации
        Route::set('a3_core_profile_edit', '(<lng>/)'.A3_ROOT_URL.'/profile')
            ->defaults(array(
                'controller' => 'profile',
                'action'     => 'index',
            ));


// роут плагинов
Route::set('a3_core_plugins', '(<lng>/)'.A3_ROOT_URL.'/plugin')
    ->defaults(array(
        'directory' => 'plugin',
        'controller' => 'dummy',
        'action'     => 'index',
    ));

// роут корневой страницы (н-р, "/ua/admin", "/admin")
Route::set('a3_core_default', '(<lng>/)'.A3_ROOT_URL)
    ->defaults(array(
        'controller' => 'login',
        'action'     => 'redirect',
    ));

