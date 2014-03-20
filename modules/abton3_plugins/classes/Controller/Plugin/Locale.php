<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Plugin_Locale
 *   Плагин локализации
 */
class Controller_Plugin_Locale extends Controller_Plugin {

    public static function getMenuTree()
    {
        return
            array(
                'cat' => array(
                    'icon' => 'flag',
                    'path' => '',
                ),
                'locales' => array(
                    'icon' => '',
                    'path' => 'index',
                ),
                'vars' => array(
                    'icon' => '',
                    'path' => 'vars',
                ),
            );
    }

    public function action_index()
    {
        $this->template->content = '123';
    }

    public function action_vars()
    {
        $this->template->content = '321';
    }

}