<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class DB_Mapper_Navigation
 */
class DB_Mapper_Navigation extends DB_Mapper
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

    public function changeSrtByID($id, $srt)
    {
        $query = DB::update($this->_tables['navigation'])
            ->set(
                array
                (
                    'srt' => $srt
                )
            )
            ->where('id', '=', $id);

        try
        {
            $query->execute();

            return
                DB_Mapper::SUCCESS;
        }
        catch (Database_Exception $e)
        {
            $this->parseDatabaseException($e);
        }
    }

    public function deleteNavigationEl($id)
    {
        $select_raw = DB::select()
            ->from($this->_tables['navigation'])
            ->where('id', '=', $id)
            ->execute()
            ->as_array();

        $page_id = $select_raw[0]['page_id'];
        $nav_sub = $select_raw[0]['sub'];

        $update_query = DB::update($this->_tables['navigation'])
            ->set(
                array
                (
                    'sub' => $nav_sub
                )
            )
            ->where('sub', '=', $id);

        $query = DB::delete($this->_tables['navigation'])
            ->where('id', '=', $id);
        $query2 = DB::delete($this->_tables['pages'])
            ->where('id', '=', $page_id);

        try
        {
            $update_query->execute();
            $query->execute();
            $query2->execute();

            return
                DB_Mapper::SUCCESS;
        }
        catch (Database_Exception $e)
        {
            return
                $this->parseDatabaseException($e);
        }
    }

    public function saveNavigationEl($id, $title, $page_title, $pref, $content, $seo_keywords, $seo_description)
    {
        $pref = str_replace('/', '', $pref);

        $select_query = DB::select('page_id')
            ->from($this->_tables['navigation'])
            ->where('id', '=', $id);

        $query = DB::update($this->_tables['pages'])
            ->set(
                array(
                    'content' => $content,
                    'page_title' => $page_title,
                    'seo_keywords' => $seo_keywords,
                    'seo_description' => $seo_description
                )
            )
            ->where('id', '=', $select_query);

        $query2 = DB::update($this->_tables['navigation'])
            ->set(
                array(
                    'title' => $title,
                    'pref' => $pref
                )
            )
            ->where('id', '=', $id);

        try
        {
            $query->execute();
            $query2->execute();

            return
                DB_Mapper::SUCCESS;
        }
        catch (Database_Exception $e)
        {
            $this->parseDatabaseException($e);
        }
    }

    public function addNavigationEl($title, $page_title, $pref, $content, $seo_keywords, $seo_description)
    {
        $pref = str_replace('/', '', $pref);

        $query = DB::insert($this->_tables['pages'],
            array('template', 'content', 'page_title', 'seo_keywords', 'seo_description'))
            ->values(
                array(
                    2,
                    $content,
                    $page_title,
                    $seo_keywords,
                    $seo_description
                )
            );

        $raw = $query->execute();
        $page_id = $raw[0];

        $query = DB::insert($this->_tables['navigation'],
            array('title', 'pref', 'enabled', 'visible', 'group', 'srt', 'sub', 'type', 'page_id'))
            ->values(
                array(
                    $title,
                    $pref,
                    1,
                    1,
                    1,
                    1000,
                    0,
                    0,
                    $page_id
                )
            );

        try
        {
            $query->execute();

            return
                DB_Mapper::SUCCESS;
        }
        catch (Database_Exception $e)
        {
            $this->parseDatabaseException($e);
        }
    }

    public function changeSubByID($id, $new_sub)
    {
        $query = DB::update($this->_tables['navigation'])
            ->set(
                array
                (
                    'sub' => $new_sub
                )
            )
            ->where('id', '=', $id);

        try
        {
            $query->execute();

            return
                DB_Mapper::SUCCESS;
        }
        catch (Database_Exception $e)
        {
            $this->parseDatabaseException($e);
        }
    }

    public function getMenuTree($group_id, $parent_id = 0)
    {
        $menu = $this->getMenuBySub($group_id, $parent_id);

        $tree = array();
        foreach ($menu as &$item)
        {
            $element = array();
            $element['fields'] = $item;
            $element['children'] = $this->getMenuTree($group_id, $item['id']);

            $tree[] = $element;
        }

        return
            $tree;
    }

    public function getMenuBySub($group_id, $parent_id)
    {
        // запрос
        $query = DB::select(
            $this->_tables['navigation'].'.id',
            $this->_tables['navigation'].'.pref',
            $this->_tables['navigation'].'.srt',
            $this->_tables['navigation'].'.sub',
            $this->_tables['navigation'].'.title',
            $this->_tables['pages'].'.content',
            $this->_tables['pages'].'.page_title',
            $this->_tables['pages'].'.seo_keywords',
            $this->_tables['pages'].'.seo_description'
        )
            ->from($this->_tables['navigation'], $this->_tables['pages'])
//            ->join($this->_tables['pages'], 'LEFT')
//            ->on($this->_tables['navigation'].'.page_id', '=', $this->_tables['pages'].'.id')
            ->where('group', '=', $group_id)
            ->and_where('sub', '=', $parent_id)
            ->and_where(DB::expr($this->_tables['navigation'].'.page_id'), '=', DB::expr($this->_tables['pages'].'.id'))
            ->order_by('srt', 'ASC');

        return
            $query
                ->execute()
                ->as_array();
    }

}