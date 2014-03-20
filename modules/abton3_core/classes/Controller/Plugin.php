<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Plugin
 *   Базовый контроллер плагинов системы
 */
class Controller_Plugin extends Controller_Authorized {

    /**
     * @var string имя плагина (со строчного символа)
     */
    private static $_name;

    /**
     * @var array массив дополнительно подключаемых скриптов и стилей (inline в шаблоне)
     */
    private $_includes = array(
        'css' => array(),
        'js' => array()
    );


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
    /**
     * @param Request $request
     * @param Response $response
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

        // получаем и передаем информацию о стилях и скриптах
        $this->script('/assets/scripts/abton/plugins/'.self::$_name.'.js'); // подключаем скрипт плагина
        $this->script('/assets/scripts/abton/plugins/'.self::$_name.'/'.$this->request->action().'.js'); // подключаем скрипт текущей страницы плагина
        $this->formJsAndCSS();
        $this->template->css = $this->_includes['css'];
        $this->template->js = $this->_includes['js'];

        // передаем имя текущего плагина
        $this->template->plugin_name = self::$_name;

        // получаем массив локализации плагина
        $plugin_lang_array = Instance_L10n::get()->getConstantsArray('plugin/'.self::$_name);
        View::set_global('plugin_array', $plugin_lang_array);

        View::set_global('ajax_url', Instance_Routing::get()->makeUrl(self::$_name.'/ajax'));

        // защита от CSRF-атак
        $this->template->token = Instance_Security::get()->getCSRFToken();
    }


    /*
     * Служебные методы плагинов
     */


    /**
     * @return array возвращает дерево меню для этого плагина
     */
    public static function getMenuTree()
    {
        return
            array();
    }


    /**
     * @param $search_string
     * @return bool
     */
    public static function getSearchResults($search_string)
    {
        return
            false;
    }

    /**
     * Метод, который задает кастомные стили и скрипты этого плагина
     * (используйте методы style(), script()
     */
    public function formJsAndCSS()
    {

    }

    /**
     * Добавить массивом стили и скрипты плагина
     *
     * Структура массива:
     *   array(
     *     ['css'] => array([0] => '/style.css', ...),
     *     ['js'] => array([0] => '/script.js', ...)
     *   )
     *
     * @param array $includes
     */
    public function addJsAndCSS(array $includes)
    {
        if (array_key_exists('css', $includes))
            $this->_includes['css'] = array_merge($this->_includes['css'], $includes['css']);

        if (array_key_exists('js', $includes))
            $this->_includes['js'] = array_merge($this->_includes['js'], $includes['js']);
    }

    /**
     * Добавить скрипт
     *
     * @param $script путь к скрипту (вместе с расширением)
     */
    public function script($script)
    {
        $this->_includes['js'][] = $script;
    }

    /**
     * Добавить стиль
     *
     * @param $style путь к стилю (вместе с расширением)
     */
    public function style($style)
    {
        $this->_includes['css'][] = $style;
    }

}