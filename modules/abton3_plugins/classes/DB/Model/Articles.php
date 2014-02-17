<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class DB_Model_Navigation
 */
class DB_Model_Articles extends DB_Model
{

    /**
     * @var array
     *
     * Таблицы:
     *      auth - содержит в себе информацию авторизации пользователей (логин, пароли)
     */
    protected $_tables = array(
        'articles' => 'articles',
    );


    /**
     * Создаем и возвращаем маппер для модели DB_Model_Auth
     *
     * @return DB_Mapper_Auth
     */
    public function getMapperInstance()
    {
        if (null === $this->_mapper_instance)
            $this->_mapper_instance = new DB_Mapper_Articles($this->_tables);

        return
            $this->_mapper_instance;
    }


    // -- реализация синглтона -------------------------------------------

    /**
     * @var Instance
     */
    private static $_instance;

    final private function __clone() { }

    /*
     * @return DB_Model_Auth
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