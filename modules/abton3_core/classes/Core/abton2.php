<?php defined('SYSPATH') or die('No direct script access.');

// TODO прокоментувати

class Core_Abton2
{
    public static $prefix = 'a2_';
    public static $admin_route = 'abton2';
    public static $install = false;
    public static $drop_tables = false;
    public static $language = 'ua';

    public static $plugins = array();

    public static $ajax_url = '';

    public static $log_table = '';

    /**
     * Повертає значення параметру за шляхом $name
     *
     * @param string $name назва параметру
     * @return object значення параметру
     * @uses Kohana
     */
    public static function getParam($name)
    {
        return
            Kohana::$config->load($name);
    }

    public static function setLanguage($lang)
    {
        $available = self::getParam('localization.available');

        if (!in_array($lang, $available))
            return
                false;

        self::$language = $lang;

        return
            true;
    }

    public static function pluginExists($plugin)
    {
        return (array_key_exists($plugin, Core_Abton2::$plugins));
    }

    public static function getRootURL()
    {
        return
            '/'.self::$language.'/'.self::$admin_route.'/';
    }

    public static function getDefaultRoute()
    {
        $first_plugin = NULL;
        foreach (self::$plugins as $plugin)
            if (Core_Rights::hasPluginRights($plugin->name))
            {
                $first_plugin = $plugin;
                break;
            }

        if ($first_plugin == NULL)
            return
                self::getRootURL().'login';

        $actions = $first_plugin->getActions();

//        $i = 0;
//        while ($i < count($actions))
//        {
//            if (!Core_Rights::hasRights($first_plugin->name, 'deny_'.$actions[$i]['action']))
//                break;
//
//            $i++;
//        }

        return
            self::getRootURL().$actions[0]['route'];
    }

    public static function getCurrentURI()
    {
        $uri = $_SERVER['REQUEST_URI'];

        return
            substr($uri, 4);
    }

    public static function getLanguageArray($name, $plugins_dir = false)
    {
        // TODO перевірка на існування мови

        $path = $name.'.'.self::$language;

        if ($plugins_dir)
            $path = 'plugins/'.$path;

        return
            self::getParam($path);
    }

    public static function getLanguageVar($name, $plugins_dir = false)
    {
        list($filename, $key) = explode(".", $name, 2);
        $path = $filename.'.'.self::$language.'.'.$key;

        if ($plugins_dir)
            $path = 'plugins/'.$path;

        return
            self::getParam($path);
    }

    public static function getMenu()
    {
        $menu = array();

        foreach (self::$plugins as $plugin)
        {
            $actions = $plugin->getActions();
            $lang_arr = self::getLanguageArray($plugin->name, true);

            foreach ($actions as $action)
            {
//                if (Core_Rights::hasRights($plugin->name, 'deny_'.$action['action']))
//                    continue;

                $menu[$plugin->name]['sub'][] = array(
                    'name' => $lang_arr[ $action['name'] ],
                    'link' => self::getRootURL().$action['route'],
                    'action' => $action['action'],
                    'hidden' => isset($action['hidden']) ? $action['hidden'] : false
                );
            }

            $menu[$plugin->name]['sub_count'] = 0;
            foreach ($menu[$plugin->name]['sub'] as $item)
            {
                if (!$item['hidden'])
                    $menu[$plugin->name]['sub_count']++;
            }

            $menu[$plugin->name]['title'] = $lang_arr['menu_category'];
            $menu[$plugin->name]['name'] = $plugin->name;
        }

        return
            $menu;
    }

    /**
     * Ініціалізація модуля
     */
    public static function init(array $settings = null)
    {
        // ініціалізація назви систмених таблиць
        self::$log_table = Model_Log::getTablename();

        // ініціалізація параметрів
        foreach ($settings as $key => $param)
            if (property_exists('Core_Abton2', $key))
                self::$$key = $param;
            else ;
                //throw new Core_Exception("Property do");
                // TODO помилка - не правильний параметр (не існує)

        self::$language = self::getParam('localization.default');

        // задання базових роутів Abton2
        self::$ajax_url = Core_Abton2::$admin_route.'/ajax';
        Route::set(self::$prefix.'ajax', self::$ajax_url)
            ->defaults(
                array(
                    'controller' => 'ajax',
                    'action'     => 'index',
                )
            );
        self::$ajax_url = '/'.self::$ajax_url;

        Route::set(self::$prefix.'login', '(<lang>/)'.self::$admin_route.'/login')
            ->defaults(
                array(
                    'controller' => 'login',
                    'action'     => 'index',
                )
            );

        Route::set(self::$prefix.'temp_link', '(<lang>/)'.self::$admin_route.'/login/<hash>')
            ->defaults(
                array(
                    'controller' => 'login',
                    'action'     => 'temp',
                )
            );

        Route::set(self::$prefix.'login_redirect', '(<lang>/)'.self::$admin_route)
            ->defaults(
                array(
                    'controller' => 'login',
                    'action'     => 'redirect',
                )
            );

        //роут для завантаження файлів
        Route::set(self::$prefix.'down', '(<lang>/)'.self::$admin_route.'/down')
            ->defaults(
                array(
                    'controller' => 'down',
                    'action'     => 'index',
                )
            );

        $auth = new Model_Auth(); // модель таблиці авторизації
        $log = new Model_Log(); // модель для ведення історії
        $messages = new Model_Messages(); // модель для повідомлень користувачів

        // видалення системних таблиць (якщо вказано)
        if (self::$drop_tables)
        {
            $auth->dropTables();
            $log->dropTables();
            $messages->dropTables();
        }

        // створення системних таблиць (якщо вказано)
        if (self::$install)
        {
            $auth->createTables();
            $log->createTables();
            $messages->createTables();
        }

//        $auth->changeUserPassword(1, '767637');
//        $messages->sendMessage(1, 2, 'test message', 'here is text of body');
    }

    public static function plugins(array $plugins = null)
    {
        // якщо не передано жодного плагіну - видаємо помилку
        if (count($plugins) == 0)
            throw new Core_Exception("Не додано жодного плагіна!");

        foreach ($plugins as $name)
        {
            // перевірка на існування такого плагіну в списку уже створених
            if (array_key_exists($name, self::$plugins))
                throw new Core_Exception("Неможливо додати плагін $name - він уже був доданий раніше");

            // формуємо назву класу плагіна
            $class_name = 'Plugin_'.$name;

            // перевірка на існування відповідного класу для плагіна з таким ім'ям
            if (!class_exists($class_name))
                throw new Core_Exception("Неможливо додати плагін $name - його не існує!");

            // створюємо екземпляр класу плагіна...
            $reflection = new ReflectionClass($class_name);
            $plugin = $reflection->newInstanceArgs(array($name));

            // ... та додаємо до масиву плагінів
            self::$plugins[] = $plugin;

            // додавання усіх роутів класу
            $routes = $plugin->getActions();

            if (count($routes) == 0) // якщо в плагіні немає action'ів, то видаємо помилку
                throw new Core_Exception("Плагін $name не має action'ів!");

            foreach ($routes as $route)
            {
                Route::set(Core_Abton2::$prefix.$route['name'], '(<lang>/)'.Core_Abton2::$admin_route.'/'.$route['route'])
                    ->defaults(
                        array
                        (
                            'directory'  => 'plugin',
                            'controller' => $name,
                            'action'     => $route['action'],
                        )
                    );
            }

            // формування імені класу моделі для цього плагіна
            $model_name = 'Model_Plugin_'.$name;

            // перевірка на існування відповідного класу моделі для плагіна з таким ім'ям
            if (class_exists($model_name))
            {
                // створюємо модель
                $reflection = new ReflectionClass($model_name);
                $model = $reflection->newInstanceArgs();

                // видалення таблиць, якщо вказано
                if (self::$drop_tables)
                    $model->dropTable();

                // створення неіснуючих таблиць плагінів, якщо вказано
                if (self::$install)
                    $model->createTable();
            }
        }
    }

    public static function checkAuth(Controller $controller)
    {
        // перевірка на авторизованість користувача
        $is_auth = Session::instance()->get('is_auth', false);

        if (!$is_auth) // якщо користувач не авторизований (наприклад, зайшов вперше чи вичерпано TTL цієї сесії)
        {
            if (strpos($_SERVER['REQUEST_URI'], 'ajax') === false)
                Session::instance()->set('requested_uri', $_SERVER['REQUEST_URI']); // записуємо до сесії URI, який запитував користувач
            else
                Session::instance()->set('requested_uri', Core_Abton2::getDefaultRoute());

            $controller->request->abton2_redirect('/login'); // редірект на сторінку авторизації
        }

        // перевіряємо чи не вичерпано час сесії (якщо не було відмічено remember me)
        $remember = Session::instance()->get('remember');

        if (isset($remember))
        {
            $time_diff = time() - $remember;
            $ttl = Core_Abton2::getParam('security.short_session_length');

            if ($time_diff > $ttl)
                Session::instance()->set('is_auth', false);
        }
    }

    public static function error_404()
    {
        Request::current()->abton2_redirect('/404');
    }


    public static function table($name)
    {
        return
            self::$prefix.$name;
    }

}