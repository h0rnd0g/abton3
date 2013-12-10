<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class DB_Mapper
 */
abstract class DB_Mapper
{

    /*
     * Коды результата выполнения запросов
     */
    const SUCCESS = 0;
    const ERROR_DUPLICATE_ENTRY = 1062;


    /**
     * @var array массив имен таблиц
     */
    protected $_tables = array();


    /**
     * абстрактная функция создания таблиц маппером
     *
     * @return ничего
     */
    abstract public function createTables();


    /**
     * Функция обрабатывает известные типы ошибок БД и возвращает
     * ассоциативный массив с ключом 'code' - кодом ошибки.
     *
     * Остальные ключи массива зависят от ошибки:
     * 1) ERROR_DUPLICATE_ENTRY
     *      'field' - название поля таблицы с атрибутом UNIQUE, по которому было дублирование
     *      'value' - значение, которое дублируется по этому полю
     *
     * @param Database_Exception $e полученное исключение БД
     * @return array данные про ошибку
     */
    protected function parseDatabaseException(Database_Exception $e)
    {
        $error['code'] = $e->getCode();
        $message = $e->getMessage();

        if ($error['code'] == self::ERROR_DUPLICATE_ENTRY)
        {
            /*
             * Для ошибки с дублированием значения по полю с атрибутом UNIQUE
             */

            // выдергиваем значение дублированного поля
            $error['value'] = Helper_String::getStringBetween($message, 'entry \'', '\'');

            // выдергиваем название дублированного поля
            $error['field'] = Helper_String::getStringBetween($message, 'key \'', '\'');
        }

        return
            $error;
    }


    /**
     * функция, которая удаляет все таблицы, переданные в наш маппер
     */
    public function dropTables()
    {
        foreach ($this->_tables as $table)
        {
            DB::query(null, "DROP TABLE IF EXISTS $table")
                ->execute();
        }
    }


    /**
     * Конструктор маппера, получает массив названий таблиц
     *
     * @param array $tables
     */
    function __construct(array $tables)
    {
        $this->_tables = $tables;
    }

}