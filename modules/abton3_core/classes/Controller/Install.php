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


    public function before()
    {
        parent::before();

        // если система уже установлена, то делаем редирект в корень
        if (Instance_Security::get()->isInstalled())
            Instance_Routing::get()->abtonRedirect();

        // чистим отметки об авторизации (если остались с предыдущей системы)
        Instance_Security::get()->logout();
    }


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

        $this->template->existing_languages = Instance_L10n::get()->getExistingLanguages();

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

        // получаем входные данные
        $data = Instance_Security::get()->getAjaxSource();

        // проверяем соединение с БД MySQL
        try
        {
            $link = mysqli_connect($data['hostname'], $data['login'], $data['password'], $data['db']);
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
        $error_handler = new Ajax_Errors(); // конструктор ошибок обработки запроса

        try
        {
            // защита от CSRF-атак (проверка)
            Instance_Security::get()->checkRequestToken();

            // отменяем отрисовку шаблона (так как обработчик ajax)
            $this->auto_render = false;


            /*
             * Обработка запроса на установку
             */

            $source = Instance_Security::get()->getAjaxSource();
            $data = Instance_Security::get()->parseAjaxData($source['data']);

            // валидация данных запроса


            /*
             * Подготовка данных и их запись в файлы конфигураций
             */

            Kohana::$config
                ->load('l10n')
                ->set('available_languages', $data['misc-langs'])
                ->set('default_language', $data['misc-l10n-default'])
                ->save();

            Kohana::$config
                ->load('database')
                ->set('default.hostname', $data['mysql-hostname'])
                ->set('default.database', $data['mysql-database'])
                ->set('default.username', $data['mysql-login'])
                ->set('default.password', $data['mysql-password'])
                ->set('cms_table_prefix', $data['mysql-prefix'])
                ->save();

            Kohana::$config
                ->load('routing')
                ->set('site_url', $data['misc-siteurl'])
                ->set('root_url_part', $data['misc-prefix'])
                ->save();

            $hash_data = explode(',', $data['security-hash-func']); // разбиваем переданную строку на два значения
            $hash_func_name = $hash_data[0]; // 1) название алгоритма хэширования
            $hash_length = $hash_data[1];    // 2) длина хэша указанного алгоритма
            $use_salt = isset($data['security-use-salt']);

            // запись параметров безопасности
            $security_config = Kohana::$config
                ->load('security');

            $security_config
                ->set('hash_method', $hash_func_name)
                ->set('hash_length', $hash_length)
                ->set('use_salt', $use_salt);

            // если не используем соль, то и длина не должна быть указана
            if ($use_salt == false)
                $security_config
                    ->set('salt_length', 0);
            else
                $security_config
                    ->set('salt_length', Instance_Security::get()->getSaltLength());

            $security_config
                ->save();

            // инсталируем систему, создавая необходимые структуры БД (системные + подключенных модулей), предварительно удаляя уже существующие
            $core_model = Data_Factory::model('core');
            $core_model
                ->uninstall()
                ->install();

            // создаем пользователя
            $user = Data_Core_Object_User::create();
            $user->login = $data['admin-login'];
            $user->password = $data['admin-password'];
            $user->email = $data['admin-email'];

            $core_model->addUser($user);

            // здесь устанавливаем включенные плагины ---
            $plugins = Kohana::$config->load('plugins.included');

            foreach ($plugins as $plugin)
            {
                $model_name = 'Model_Plugin_'.$plugin;

                if (class_exists($model_name) and method_exists($model_name, 'install'))
                    $model_name::install();
            }
            // --- конец установки плагинов


            // если были ошибки, то возвращаем их
            if ($error_handler->haveErrors())
                Instance_Security::get()->ajaxResponse(false, $error_handler->getErrors());
            else
            {
                // иначе возвращаем успех с необходимыми данными
                $success_data = array(
                    'root' => $data['misc-prefix'] // возвращаем префикс url админки, чтобы правильно сформировать редирект
                );
                Instance_Security::get()->ajaxResponse(true, $success_data);

                Instance_Security::get()->markInstalled(); // ставим флаг о том, что установка произведена
                return; // заканчиваем выполнение установки
            }

        }
        catch (Exception $e)
        {
            // непредусмотренная ошибка
            $error_handler->addError('unknown', array('message' => $e->getMessage()));

            Instance_Security::get()->ajaxResponse(false, $error_handler->getErrors());
        }

        /*
         * При отсутствии ошибок идет выброс из функции, поэтому
         * сюда дойдем только при наличии ошибок.
         *
         * Следовательно, нужно выполнить откат
         */

        //DB_Model_Auth::get()->dropTables();
    }

}