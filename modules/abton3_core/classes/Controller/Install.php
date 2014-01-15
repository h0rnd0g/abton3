<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Base
 *   Контроллер инсталятора системы
 */
class Controller_Install extends Controller_Base {

    /**
     * @var string шаблон инсталлятора
     */
    public $template = 'template_install';


    /**
     * Базовый action инсталлятора
     */
    public function action_index()
    {
        // генерируем CSRF токен (для защиты ajax)
        Instance_Security::get()->initCSRFToken();

        /*
         * Передача данных к шаблону
         */
        $this->template->lang_array = Instance_L10n::get()->getConstantsArray('install_page');

        $this->template->test_db_ajax = Instance_Routing::get()->route('core_install_test');
        $this->template->install_ajax = Instance_Routing::get()->route('core_install_perform');

        $this->template->token = Instance_Security::get()->getCSRFToken();
    }


    /**
     * Проверка соединения с БД MySQL
     */
    public function action_test()
    {
        // защита от CSRF-атак (проверка)
        Instance_Security::get()->checkRequestToken();

        // отменяем отрисовку шаблона (так как обработчик ajax)
        $this->auto_render = false;

        // проверяем соединение с БД MySQL
        try
        {
            $link = mysqli_connect($_POST['hostname'], $_POST['login'], $_POST['password'], $_POST['db']);
            mysqli_close($link);

            $success = true; // успех
        }
        catch (Exception $e)
        {
            $success = false; // ошибка
        }

        Instance_Security::get()->ajaxResponse($success);
    }


    /**
     * Установка системы управления
     */
    public function action_install()
    {
        try
        {
            // защита от CSRF-атак (проверка)
            Instance_Security::get()->checkRequestToken();

            // отменяем отрисовку шаблона (так как обработчик ajax)
            $this->auto_render = false;


            /*
             * Обработка запроса на установку
             */

            $data = Instance_Security::get()->parseAjaxData($_POST['data']);
            $error_handler = new Ajax_Errors();

            // валидация данных запроса


            // подготовка данных и их запись в файлы конфигураций
            Kohana::$config
                ->load('database')
                ->set('default.hostname', $data['mysql-hostname'])
                ->set('default.database', $data['mysql-database'])
                ->set('default.username', $data['mysql-login'])
                ->set('default.password', $data['mysql-password'])
                ->save();

            $hash_data = explode(',', $data['security-hash-func']); // разбиваем переданную строку на два значения
            $hash_func_name = $hash_data[0]; // 1) название алгоритма хэширования
            $hash_length = $hash_data[1];    // 2) длина хэша указанного алгоритма
            $use_salt = isset($data['security-use-salt']);

            Kohana::$config
                ->load('security')
                ->set('hash_method', $hash_func_name)
                ->set('hash_length', $hash_length)
                ->set('use_salt', $use_salt)
                ->save();

            // создаем таблицы в БД (системные + подключенных модулей)


            // создаем пользователя


            Instance_Security::get()->ajaxResponse($error_handler->haveErrors(), $error_handler->getErrors());
        }
        catch (Exception $e)
        {
            // непредусмотренная ошибка
            $error_handler->addError('unknown', array('message' => $e->getMessage()));

            Instance_Security::get()->ajaxResponse(false, $error_handler->getErrors());
        }

        // если были ошибки
        if ($error_handler->haveErrors())
        {
            // ... выполняем откат
        }
        else
        {
            Instance_Security::get()->markInstalled(); // ... иначе ставим флаг о том, что установка произведена
        }
    }

}