<?php defined('SYSPATH') OR die('No direct script access.');

class Data_Test_Mapper_SQL extends Data_Test_Mapper {

    public function add(Data_Test_Object $object)
    {
        $query = DB::insert('test', $object->formRawKeys())
            ->values($object->formRawValues());

        $query->execute();
    }

    public function save(Data_Test_Object $object)
    {
        //$query = DB::update()
    }

    public function getByID($id)
    {

    }

}