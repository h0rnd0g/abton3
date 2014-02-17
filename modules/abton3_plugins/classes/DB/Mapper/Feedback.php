<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class DB_Mapper_Navigation
 */
class DB_Mapper_Feedback extends DB_Mapper
{

    /**
     * Создаем таблицы для плагина навигации
     */
    public function createTables()
    {
        // TODO: transaction

        // запрос на создание таблицы templates
        $sql_create =
            "CREATE TABLE IF NOT EXISTS {$this->_tables['templates']} (
                `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'PK',
                `name` varchar(255) NOT NULL COMMENT 'view name',
                `block_count` int(4) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'echo blocks in view'
            ) CHARACTER SET utf8 COLLATE utf8_general_ci, engine=InnoDB;";

        DB::query(null, $sql_create)
            ->execute();

        // запрос на создание таблицы navigation
        $sql_create =
            "CREATE TABLE IF NOT EXISTS {$this->_tables['navigation']} (
                `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'PK',
                `group` int(11) UNSIGNED NOT NULL COMMENT 'group of menu',
                `sub` int(11) UNSIGNED NOT NULL COMMENT 'tree structure sub',
                `pref` VARCHAR(40) NOT NULL COMMENT 'element pref',
                `type` int(1) NOT NULL COMMENT '0 - static with page, 1 - url',
                `param` text NOT NULL COMMENT 'json params of element'
            ) CHARACTER SET utf8 COLLATE utf8_general_ci, engine=InnoDB;";

        DB::query(null, $sql_create)
            ->execute();

        // запрос на создание таблицы navigation_pages
        $sql_create =
            "CREATE TABLE IF NOT EXISTS {$this->_tables['pages']} (
                `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'PK',
                `nav_id` int(11) UNSIGNED NOT NULL COMMENT 'FK to navigation.id',
                `content` text NOT NULL DEFAULT '' COMMENT 'here comment of the page',
                `title` text NOT NULL DEFAULT '' COMMENT 'here title of the page',
                `seo_keywords` text NOT NULL DEFAULT '' COMMENT 'keywords of the page (for SEO)',
                `seo_description` text NOT NULL DEFAULT '' COMMENT 'description of the page (for SEO)'
            ) CHARACTER SET utf8 COLLATE utf8_general_ci, engine=InnoDB;";

        DB::query(null, $sql_create)
            ->execute();

        // запрос на создание таблицы navigation_titles
        $sql_create =
            "CREATE TABLE IF NOT EXISTS {$this->_tables['titles']} (
                `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'PK',
                `nav_id` int(11) UNSIGNED NOT NULL COMMENT 'FK to navigation.id',
                `enabled` int(1) NOT NULL COMMENT 'if this route is enabled (404 if not)',
                `srt` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'sorting number for element order in menu',
                `title` text NOT NULL DEFAULT '' COMMENT 'title for menu item',
                `description` text NOT NULL DEFAULT '' COMMENT 'description for menu item'
            ) CHARACTER SET utf8 COLLATE utf8_general_ci, engine=InnoDB;";

        DB::query(null, $sql_create)
            ->execute();
    }

}