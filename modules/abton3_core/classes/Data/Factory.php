<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Data_Factory
 */
class Data_Factory {

    public static function mapper($name)
    {
        $type = 'SQL';

        $class_name = "Data_{$name}_Mapper_{$type}";
        $mapper = new $class_name;

        return $mapper;
    }

    public static function model($name)
    {
        $mapper = Data_Factory::mapper($name);

        $class_name = "Data_{$name}_Model";
        $model = new $class_name($mapper);

        return $model;
    }

}