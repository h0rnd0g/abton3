<?php defined('SYSPATH') or die('No direct script access.');

// -- Инициализация модуля ядра -------------------------------------------------

/**
 * Проверка на наличие необходимых компонентов системы для ядра
 */
if (!array_key_exists('database', Kohana::modules()))
    die('Can\'t initialize Abton4 CMS! Kohana Database module required!');

/**
 * Подготовка среды Kohana
 */
Cookie::$salt = 'abton3_cms_salt1!2@3#4$5%'; // соль для защиты хэшей cookie
//Cookie::$domain = Instance_Routing::get()->getRootUrl(); // cookie будут доступны только с нашего домена
Cookie::$httponly = true; // запрещаем доступ к cookie из скриптов

/**
 * Инициализация роутов ядра и плагинов
 */
require_once MODPATH.'abton3_core/routes.php';

Instance_Plugins::get()->formPluginRoutes();