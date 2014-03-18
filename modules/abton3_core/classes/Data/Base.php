<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Data_Base
 */
abstract class Data_Base {

    abstract public function install();
    abstract public function uninstall();

}