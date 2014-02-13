<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Instance_Routing
 */
class Instance_Routing extends Instance {

    /**
     * @var корневой URL-префикс системы управления
     */
    private static $_root_url;


    /*
     * Достает префикс адресов системы управления
     *
     * @return string $_getRootUrl
     */
    public function getRootUrl()
    {
        return
            self::$_root_url;
    }


    /**
     * Возвращает всю часть ссылки системы управления (вместе с текущим языком и префиксом)
     *
     * @return string
     */
    public function getPrefixHref()
    {
        $lang = Instance_L10n::get()->getLanguage();
        $root = Instance_Routing::get()->getRootUrl();

        return
            '/'.$lang.'/'.$root.'/';
    }


    /**
     * Генерирует ссылку по имени системного роута
     *
     * @param $route_name имя роута (без префикса a3_ !!!)
     * @param null $lang язык, который будет передаваться в роут
     * @param array $params остальные параметры (если есть) для передачи в роут
     * @return string
     */
    public function route($route_name, $lang = null, array $params = array())
    {
        // добавляем префикс
        $route_name = 'a3_'.$route_name;

        // если язык не указан, то берем текущий
        if (!isset($lang))
            $lang = Instance_L10n::get()->getLanguage();

        // формируем параметры, подставив язык
        $lang_array = array('lng' => $lang);
        $params = array_merge($lang_array, $params);

        return
            Route::url($route_name, $params);
    }


    /**
     * @param $path конечная часть ссылки
     * @return string возвращает полностью ссылку с префиксом и конечной частью
     */
    public function makeUrl($path)
    {
        return
            $this->getPrefixHref().$path;
    }


    /**
     * Редирект внутри системы
     *
     *  (если $path не указан, то редирект идет на стартовую страницу системы)
     *
     * @param null $path адрес внутри системы управления (не должен начинаться со слеша)
     * @param null $lang язык (если не указан, то берется текущий)
     */
    public function abtonRedirect($path = null, $lang = null)
    {
        // редирект относительно пути $path сгенериурет весь путь с префиксом системы управления и текущим языком

        if (!isset($lang))
            $lang = Instance_L10n::get()->getLanguage();

        if (!isset($path))
        {
            $tree = Instance_Plugins::get()->getMenu();
            $path = $tree[0]['tree'][0]['route'];
        }

        HTTP::redirect('/'.$lang.'/'.Instance_Routing::get()->getRootUrl().'/'.$path);
    }


    /*
     * Инициализация
     */
    protected function __construct()
    {
        self::$_root_url = Kohana::$config->load('routing.root_url_part');
    }

    // -- реализация синглтона -------------------------------------------

    /**
     * @var Instance
     */
    private static $_instance;

    final private function __clone() { }

    /*
     * @return Instance_Routing
     */
    public static function get()
    {
        // если переменная пуста...
        if (null === self::$_instance)
            // ...то создаем объект класса
            self::$_instance = new self();

        return
            self::$_instance;
    }

}