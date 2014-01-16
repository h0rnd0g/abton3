<?php defined('SYSPATH') OR die('No direct script access.');

/*
 * DB_Exception
 *   Класс исключений для работы с БД
 */
class DB_Exception extends Exception {


    /**
     * @var array ассоциативный массив с пропаршеной из сообщения информацией об ошибке БД
     */
    protected $_exception_data = array();

    /*
     * Get & Set
     */
    public function getData()
    {
        return
            $this->_exception_data;
    }

    /**
     * Конструктор исключения
     *
     * @param array $data ассоциативный массив с пропаршеной из сообщения информацией об ошибке БД
     * @param string $message сообщение исключения
     * @param int $code код исключения
     */
    public function __construct(array $data, $message = "", $code = 0)
    {
        parent::__construct($message, $code);

        $this->_exception_data = $data;
    }

}
