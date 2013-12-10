<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class DB_Object
 */
abstract class DB_Object
{

    const PK_AUTO_INCREMENT = 0;
    const TIMESTAMP_NOW = null;

    /**
     * @var integer Primary Key
     */
    protected $_id = 0;


    /*
     * Get & Set
     */

    public function getID()
    {
        return
            $this->_id;
    }

    public function setID($id)
    {
        $this->_id = $id;
    }


    /**
     * Базовый конструктор класса объекта БД
     *
     * @param $id Primary Key записи в таблице
     */
    function __construct($id)
    {
        $this->setID($id);
    }

}