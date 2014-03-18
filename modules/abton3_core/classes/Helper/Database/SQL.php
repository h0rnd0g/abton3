<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Helper_Database
 *   Воспомогательный статический класс-хелпер для популярных запросов к БД
 */
class Helper_Database_SQL
{

    public static function transactionStart()
    {
        DB::query(0, 'START TRANSACTION')
            ->execute();
    }

    public static function transactionCommit()
    {
        DB::query(0, 'COMMIT')
            ->execute();
    }

    public static function transactionRollback()
    {
        DB::query(0, 'ROLLBACK')
            ->execute();
    }

}