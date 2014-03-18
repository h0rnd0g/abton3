<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Data_Mapper
 */
abstract class Data_Mapper extends Data_Base {

    protected $tables = array();

    public function install()
    {
        return
            $this;
    }
    public function uninstall()
    {
        return
            $this;
    }

    public function __construct()
    {
        $prefix = Kohana::$config->load('database.cms_table_prefix');

        foreach ($this->tables as &$table)
        {
            $table = $prefix.$table;
        }
    }

}