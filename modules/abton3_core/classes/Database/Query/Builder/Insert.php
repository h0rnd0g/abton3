<?php defined('SYSPATH') OR die('No direct script access.');

class Database_Query_Builder_Insert extends Kohana_Database_Query_Builder_Insert {

    public function set($column, $value)
    {
        $this->_columns[] = $column;
        $this->_values[0][] = $value;

        return
            $this;
    }

}
