<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Data_Object_Test
 */
class Data_Test_Object extends Data_Object {

    protected function initFields()
    {
        parent::initFields();

        $this->fields['name'] = null;
    }

    protected function getName($value)
    {
        return $value.'123';
    }

    protected function setName($value)
    {
        $this->fields['name'] = strtoupper($value);
    }

}