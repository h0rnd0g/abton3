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
        // отменяем отрисовку шаблона (так как обработчик ajax)
        $this->auto_render = false;

        /*
         * Здесь проверка на совпадение токенов (защита от CSRF)
         */

        Instance_Security::get()->checkRequestToken();
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

        // передаем имя текущего плагина
        $this->template->plugin_name = self::$_name;

        // получаем массив локализации плагина
        $plugin_lang_array = Instance_L10n::get()->getConstantsArray('plugin/'.self::$_name);
        $this->template->plugin_array = $plugin_lang_array;
    }


    /*
     * Служебные методы плагинов
     */

    public static function getMenuTree()
    {
        return
            array();
    }


    public static function getSearchResults($search_string)
    {

    }


}