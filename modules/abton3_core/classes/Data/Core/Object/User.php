<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Data_Core_Object_User
 */
class Data_Core_Object_User extends Data_Object {

    function __set($property, $value)
    {
        if (strtolower($property) == 'password')
            $this->setPassword($value);
        else
            return
                parent::__set($property, $value);
    }

    function __get($property)
    {
        if (strtolower($property) == 'representative')
            return
                $this->getRepresentativeName();
        else
            return
                parent::__get($property);
    }

    protected function initFields()
    {
        parent::initFields();

        $this->fields['login'] = null;
        $this->fields['hash'] = null;
        $this->fields['email'] = null;
        $this->fields['right_group'] = null;
        $this->fields['profile'] = null;
    }

    protected function setPassword($password)
    {
        $this->hash = Instance_Security::get()->hash($password);
    }

    public function setLogin($login)
    {
        $login = strtolower($login); // логин всегда в нижнем регистре

        // конструктор валидатора и его правил
        $input = new Validation(array('login' => $login));
        $input
            ->rule('login', 'not_empty') // не пустой
            ->rule('login', 'regex', array(':value', '/^[a-z_.]{3,16}$/'));

        /*
            регулярное выражение /^[a-z_.]{3,16}$/
                - только малые латинские, символ подчеркивания или точка
                - длина от 3 до 16 символов включительно
        */

        // проверка на прохождение валидации
        if ($input->check())
            $this->fields['login'] = $login;
        else
            throw new Validation_Exception($input);
    }

    public function setEmail($email)
    {
        // конструктор валидатора и его правил
        $input = new Validation(array('email' => $email));
        $input
            ->rule('email', 'not_empty')
            ->rule('email', 'email');

        // проверка на прохождение валидации
        if ($input->check())
            $this->fields['email'] = $email;
        else
            throw new Validation_Exception($input);
    }

    public function getRepresentativeName()
    {
        if (isset($this->profile))
            if (isset($this->profile->name))
                return
                    $this->profile->name;

        return
            $this->login;
    }

}