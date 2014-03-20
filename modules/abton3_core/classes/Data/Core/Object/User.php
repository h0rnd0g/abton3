<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Data_Core_Object_User
 */
class Data_Core_Object_User extends Data_Object {

    protected $_profile = null;

    protected function initFields()
    {
        parent::initFields();

        $this->fields['login'] = null;
        $this->fields['hash'] = null;
        $this->fields['email'] = null;
        $this->fields['right_group'] = null;
    }

    protected function getRepresentative()
    {
        if (isset($this->profile))
            if (isset($this->profile->name))
                return
                    $this->profile->name;

        return
            $this->login;
    }

    protected function getProfile()
    {
        // реализация lazyload
        if (($this->_profile === null) and ($this->id !== null))
        {
            $core_model = Data_Factory::model('core');
            $this->_profile = $core_model->getProfileByID($this->id);

            return
                $this->_profile;
        }

        return
            $this->_profile;
    }

    protected function setProfile(Data_Core_Object_Profile $profile)
    {
        $this->lprofile = $profile;
    }

    protected function setPassword($password)
    {
        $this->hash = Instance_Security::get()->hash($password);
    }

    protected function setLogin($login)
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

    protected function setEmail($email)
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

}