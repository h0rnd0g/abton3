<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Plugin
 *   Базовый контроллер плагинов системы
 */
class Controller_Plugin extends Controller_Authorized {

    private static $_name;


    /*
     * Get & Set
     */

    public function getPluginName()
    {
        return
            self::$_name;
    }


    /*
     * В конструкторе добавляем определение имени плагина исходя из имени его класса контроллера
     */
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);

        // определяем имя плагина
        $class_name = get_class($this);
        self::$_name = strtolower( str_replace('Controller_Plugin_', '', $class_name) );
    }


    /**
     * Ajax-метод плагина
     */
    public function action_ajax()
    {
        /*
         * Здесь проверка на совпадение токенов (защита от CSRF)
         */

        if (!isset($_REQUEST['token']))
        {
            // если не передали токен в запрос, то скорее всего была произведена CSRF-атака

            $headers_string = print_r(getallheaders(), true); // запекаем шапку запроса

            // выводим в лог предупреждение о запросе без токена + его заголовки
            Log::instance()->add(Log::ERROR,
                'Abton3 CMS :: On Controller_Plugin::action_ajax() : there was an attempt to execute ajax query without token! Here is query\'s headers: '.$headers_string
            );

            die('Permission denied!');
        }
        elseif ( $_REQUEST['token'] != Instance_Security::get()->getCSRFToken() ) // сравниваем токены
        {
            // если токены не равны, то скорее всего была произведена CSRF-атака

            $headers_string = print_r(getallheaders(), true); // запекаем шапку запроса

            // выводим в лог предупреждение о CSRF  + его заголовки
            Log::instance()->add(Log::WARNING,
                'Abton3 CMS :: On Controller_Plugin::action_ajax() : there was an attempt to execute ajax query with wrong token! Here is query\'s headers: '.$headers_string
            );

            die('Permission denied!');
        }
    }


    /**
     * Выполняется перед вызовом action'а
     */
    public function before()
    {
        parent::before();

        /*
         * обработка плагино-зависимых данных
         */

        // получаем массив локализации плагина
        $plugin_lang_array = Instance_L10n::get()->getConstantsArray('plugin/'.self::$_name);
        $this->template->plugin_array = $plugin_lang_array;
    }


    /*
     * Служебные методы плагинов
     */

    public static function getMenuTree()
    {

    }


    public static function getSearchResults($search_string)
    {

    }


}