<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Data_Core_Model
 */
class Data_Core_Model extends Data_Model implements Data_Core_Interface {

    public function addUser(Data_Core_Object_User $user)
    {
        return
            $this->mapper->addUser($user);
    }

    public function getUserByLogin($login)
    {
        return
            $this->mapper->getUserByLogin($login);
    }

    public function getUserByID($id)
    {
        return
            $this->mapper->getUserByID($id);
    }

    public function getProfileByID($id)
    {
        return
            $this->mapper->getProfileByID($id);
    }

    public function __construct(Data_Core_Mapper $mapper)
    {
        parent::__construct($mapper);
    }

}