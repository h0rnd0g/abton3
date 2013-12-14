<?php defined('SYSPATH') or die('No direct script access.');

// TODO прокоментувати

/**
 * Class Core_Plugin
 *
 * @author     Serhiy "deus krid" Yaniuk
 * @copyright  (c) 2013 deus krid
 */
abstract class Core_Plugin
{
    public $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    abstract public function getActions();

    public function getLanguageVariables()
    {
        return
            Core_Abton2::getParam($this->name);
    }

}