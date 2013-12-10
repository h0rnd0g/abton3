<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Instance_Messages
 */
class Instance_Messages extends Instance {

    const MESSAGE_INFO = 'info';
    const MESSAGE_SUCCESS = 'success';
    const MESSAGE_ERROR = 'error';
    const MESSAGE_WARNING = 'warning';

    protected $_messages = array();

    public function addMessage($type, $title, $description)
    {
        $this->_messages[] = array(
            'type' => $type,
            'title' => htmlspecialchars($title, ENT_QUOTES),
            'description' => htmlspecialchars($description, ENT_QUOTES)
        );
    }

    public function getMessagesScript()
    {
        $js_view = View::factory('messages');
        $js_view->messages = $this->_messages;

        return
            $js_view->render();
    }

    /*
     * Инициализация
     */
    protected function __construct() {}

    // -- реализация синглтона -------------------------------------------

    /**
     * @var Instance
     */
    private static $_instance;

    final private function __clone() { }

    /*
     * @return Instance_Messages
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