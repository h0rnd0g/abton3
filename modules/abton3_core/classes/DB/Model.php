<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class DB_Model
 */
abstract class DB_Model
{

    /**
     * @var array массив названий таблиц модели (БЕЗ ПРЕФИКСОВ! Он генерируется в конструкторе)
     */
    protected $_tables = array();


    /**
     * @var DB_Mapper объект-обертка модели
     */
    protected $_mapper_instance;


    /**
     * Конструктор (для инициализации имен таблиц (добавления префикса) и создания маппера)
     */
    function __construct()
    {
        $prefix = Kohana::$config->load('database.cms_table_prefix');

        // добавляем префикс к названием таблиц
        foreach ($this->_tables as &$table)
            $table = $prefix.$table;

        // создаем объект-маппер для нашей модели
        $this->_mapper_instance = $this->getMapperInstance();
    }


    /**
     * Метод должен быть описан в каждой модели!
     *
     * @return DB_Mapper возвращает объект-маппер для модели
     */
    abstract public function getMapperInstance();


    /**
     * Создание таблиц модели
     *
     * @param bool $drop_if_exist если true, то таблицы сначала будут удалены (если существуют с такими же именами)
     */
    public function createTables($drop_if_exist = false)
    {
        // если передан флаг true удаления существующих
        if ($drop_if_exist)
            $this->dropTables(); // то сперва пробуем удалить таблицы

        // вызываем констурктор таблиц нашего текущего маппера
        $this->_mapper_instance->createTables();
    }


    /**
     * Удаление таблиц модели через маппер
     */
    public function dropTables()
    {
        // вызываем деструктор таблиц нашего текущего маппера
        $this->_mapper_instance->dropTables();
    }

}