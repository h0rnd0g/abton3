<?php defined('SYSPATH') OR die('No direct script access.');

interface Data_Test_Interface {

    public function add(Data_Test_Object $object);
    public function save(Data_Test_Object $object);
    public function getByID($id);

}