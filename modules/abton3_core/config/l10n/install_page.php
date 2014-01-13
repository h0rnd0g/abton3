<?php defined('SYSPATH') or die('No direct script access.');

// -- Файл языковых констант для страницы установки -------------------------------

return
    array
    (
        'ua' => array(
            'title' => 'Встановлення системи управління Abton3 CMS',
            'description' => 'Вкажіть основні налаштування для системи управління та натисніть кнопку "Встановити".<br> <b>Всі поля є обов\'язковими до заповнення!</b>',

            'group_mysql' => 'Налаштування MySQL',
                'label_hostname'   => 'Хост',
                'label_database'   => 'Назва бази даних',
                'label_username'   => 'Логін користувача',
                'label_password'   => 'Пароль',
                'label_tableprefix'   => 'Префікс таблиць системи управління',

            'group_admin' => 'Профіль адміністратора',
                'label_login' => 'Логін адміністратора',
                'label_login_help' => 'Лише символи A-Z, a-z, 0-9, _',
                'label_email' => 'E-mail адміністратора',
                'label_password' => 'Пароль адміністратора',

            'group_security' => 'Безпека та системи захисту',
                'label_hashfunc' => 'Хеш-функція',

            'group_misc' => 'Інші налаштування',
                'label_l10n_available' => 'Доступні локалізації системи управління',
                'label_l10n_default' => 'Локалізація по замовчуванню',
                'label_siteurl' => 'URL сайту',
                'label_cmsprefix' => 'Внутрішній префікс адрес системи управління',
                'label_cmsprefix_help' => 'Адреси сторінок системи управління матимуть вигляд "/мова/префікс/"',

            'label_button_install' => 'Встановити',
            'label_button_clear' => 'Очистити',
        ),
    );