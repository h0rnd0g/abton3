<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Interface Data_Core_Interface
 */
interface Data_Core_Interface {

    public function addUser(Data_Core_Object_User $user);
    public function getUserByLogin($login);
    public function getUserByID($id);

}