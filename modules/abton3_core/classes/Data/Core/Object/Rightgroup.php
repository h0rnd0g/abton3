<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Data_Core_Object_Profile
 */
class Data_Core_Object_Rightgroup extends Data_Object {

    protected $attributes;

    protected function initFields()
    {
        parent::initFields();

        $this->fields['name'] = null;
    }

    protected function setAttributes()
    {

    }

    protected function setName($name)
    {
        $name = strtolower($name); // имя всегда в нижнем регистре

        // конструктор валидатора и его правил
        $input = new Validation(array('name' => $name));
        $input
            ->rule('name', 'not_empty') // не пустой
            ->rule('name', 'regex', array(':value', '/^[a-z_.]{3,30}$/'));

        /*
            регулярное выражение /^[a-z_.]{3,30}$/
                - только малые латинские, символ подчеркивания или точка
                - длина от 3 до 30 символов включительно
        */

        // проверка на прохождение валидации
        if ($input->check())
            $this->fields['name'] = $name;
        else
            throw new Validation_Exception($input);
    }

}