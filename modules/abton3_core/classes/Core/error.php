<?php defined('SYSPATH') or die('No direct script access.');

// TODO закінчити клас

/**
 * Core_Exception
 *
 * @author     Serhiy "deus krid" Yaniuk
 * @copyright  (c) 2013 deus krid
 */
class Core_Error
{
    public static $errors = array();
    public static $warnings = array();

    public static function addError($name)
    {
        $errors[] = $name;
    }

    public static function addWarning($name)
    {
        $warnings[] = $name;
    }

}
