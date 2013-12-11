<?php defined('SYSPATH') or die('No direct script access.');

// -- Описание усех роутов ядра системы управления Abton3 CMS ----------------------------

/*
 * Константы
 */
define('A3_ROOT_URL', Instance_Routing::get()->getRootUrl());

/*
 * Описание роутов
 */

// роут страницы авторизации (н-р, "/ua/admin/login", "/admin/login")
Route::set('a3_core_loginscreen', '(<lng>/)'.A3_ROOT_URL.'/login')
    ->defaults(array(
        'controller' => 'login',
        'action'     => 'index',
    ));

// роут плагинов
Route::set('a3_core_plugins', '(<lng>/)'.A3_ROOT_URL.'/plugin')
    ->defaults(array(
        'controller' => 'plugin',
        'action'     => 'index',
    ));

// роут корневой страницы (н-р, "/ua/admin", "/admin")
Route::set('a3_core_default', '(<lng>/)'.A3_ROOT_URL)
    ->defaults(array(
        'controller' => 'login',
        'action'     => 'redirect',
    ));

