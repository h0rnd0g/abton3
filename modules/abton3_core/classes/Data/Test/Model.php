<?php defined('SYSPATH') OR die('No direct script access.');

class Data_Test_Model extends Data_Model implements Data_Test_Interface {

    public function add(Data_Test_Object $object)
    {
        $this->mapper->add($object);
    }

    public function save(Data_Test_Object $object)
    {
        $this->mapper->save($object);
    }

    public function getByID($id)
    {
        $this->mapper->getByID($id);
    }

    protected function __construct(Data_Test_Mapper $mapper)
    {
        parent::__construct($mapper);
    }

}