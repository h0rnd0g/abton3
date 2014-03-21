<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Model_Old
 */
class Model_Plugin_Locale {

    public static function getLocales()
    {
        $pre = Kohana::$config->load('database.cms_table_prefix');

        $query_get_locales = DB::select()
            ->from("{$pre}locale")
            ->order_by('id', 'ASC');

        return
            $query_get_locales
                ->execute()
                ->as_array();
    }

    public static function install()
    {
        $pre = Kohana::$config->load('database.cms_table_prefix');

        $query_create_locale = DB::query(0,
            "CREATE TABLE IF NOT EXISTS `{$pre}locale` (
              `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
              `value` VARCHAR(45) NULL,`pref` CHAR(3) NULL,
              `active` INT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'If !== 1 then locale is deactivated',
              PRIMARY KEY (`id`),
              UNIQUE INDEX `pref_UNIQUE` (`pref` ASC))
             ENGINE = InnoDB;"
        );

        try
        {
            Helper_Database_SQL::transactionStart();

            // выполняем запросы внутри транзакции
            $query_create_locale->execute();

            Helper_Database_SQL::transactionCommit();
        }
        catch (Database_Exception $e)
        {
            /*
             * ПРИМЕЧАНИЕ
             *
             * Да, мне известно, что в MySQL транзакции для DDL-запросов не поддерживаются.
             * Но! Если такая поддержка появится - все уже сделано :)
             *
             * До тех пор также отсюда будет выполняться удаление таблиц (тех, что мы успели создать)
             */

            // откат де-юре
            Helper_Database_SQL::transactionRollback();

            // откат де-факто
            Model_Plugin_Locale::uninstall();

            throw $e;
        }
    }

    public static function uninstall()
    {
        $pre = Kohana::$config->load('database.cms_table_prefix');

        $query_drop_locale = DB::query(0,
            "DROP TABLE IF EXISTS `{$pre}locale`"
        );

        $query_drop_locale->execute();
    }

}