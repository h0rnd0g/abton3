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

        // роут установки системы управления
        Route::set('a3_core_install_perform', '(<lng>/)'.A3_ROOT_URL.'/install/do_install')
            ->defaults(array(
                'controller' => 'install',
                'action'     => 'install',
            ));

    /*
     * роуты дополнительных плагинов
     */

        // elfinder file manager
        Route::set('a3_extra_elfinder', A3_ROOT_URL.'/elfinder')
            ->defaults(array(
                'directory' => 'extra',
                'controller' => 'elfinder'
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

// роут корневой страницы (н-р, "/ua/admin", "/admin")
Route::set('a3_core_default', '(<lng>/)'.A3_ROOT_URL)
    ->defaults(array(
        'controller' => 'login',
        'action'     => 'redirect',
    ));