<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Plugin_Dummy
 *   Плагин-пустышка (для тестов)
 */
class Controller_Plugin_Dummy extends Controller_Plugin {

    // базовый метод
    public function action_index()
    {
        //throw new Exception(self::getPluginName());
    }

}