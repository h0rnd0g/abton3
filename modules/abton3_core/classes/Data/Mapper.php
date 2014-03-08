<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Data_Mapper
 */
abstract class Data_Mapper {

    public static function create()
    {
        return (new static());
    }

    protected function __construct()
    {
    }

}