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
Cookie::$salt = '0839845797';

/**
 * Инициализация роутов ядра
 */
require_once MODPATH.'abton3_core/routes.php';