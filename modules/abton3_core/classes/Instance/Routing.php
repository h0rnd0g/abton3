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
     * @return $_getRootUrl
     */
    public function getRootUrl()
    {
        return
            self::$_root_url;
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