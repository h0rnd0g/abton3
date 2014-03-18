<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Data_Core_Object_Profile
 */
class Data_Core_Object_Rightgroup extends Data_Object {

    protected function initFields()
    {
        parent::initFields();

        $this->fields['name'] = null;
    }

}