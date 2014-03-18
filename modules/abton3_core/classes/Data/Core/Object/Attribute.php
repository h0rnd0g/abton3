<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Data_Core_Object_Attribute
 */
class Data_Core_Object_Attribute extends Data_Object {

    protected function initFields()
    {
        parent::initFields();

        $this->fields['key'] = null;
    }

}