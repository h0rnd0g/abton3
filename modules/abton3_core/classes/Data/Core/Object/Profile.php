<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Data_Core_Object_Profile
 */
class Data_Core_Object_Profile extends Data_Object {

    protected function initFields()
    {
        /*
         * мы не вызываем метод parent-класса, потому что поле id в таблице не существует
         * ( чтобы не делать здесь лишнего unset() )
         */

        $this->fields['core_users_id'] = null;
        $this->fields['name'] = null;
        $this->fields['occupation'] = null;
        $this->fields['description'] = null;
        $this->fields['phone'] = null;
    }

}