<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Plugin_Dummy
 *   Плагин-пустышка (для тестов)
 */
class Controller_Plugin_Dummy extends Controller_Plugin {

    public static function getMenuTree()
    {
        return
            array(
                'index' => array(
                    'icon' => 'cogs',
                    'path' => '',
                ),
                'show' => array(
                    'icon' => '',
                    'path' => 'index',
                ),
                'care' => array(
                    'icon' => '',
                    'path' => 'care',
                ),
            );
    }

    // базовый метод
    public function action_index()
    {
        $this->template->content = 'index';
    }

    public function action_care()
    {
        $this->template->content = 'care';
    }

}