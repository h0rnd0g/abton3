<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Plugin_Dummy
 *   Плагин-пустышка (для тестов)
 */
class Controller_Plugin_Navigation extends Controller_Plugin {

    public static function getMenuTree()
    {
        return
            array(
                'index' => array(
                    'icon' => 'list',
                    'path' => '',
                ),
                'pages' => array(
                    'icon' => '',
                    'path' => 'index',
                ),
                'static' => array(
                    'icon' => '',
                    'path' => 'static',
                ),
            );
    }

    // базовый метод
    public function action_index()
    {
        DB_Model_Navigation::get()->getMapperInstance()->createTables();
    }

    public function action_static()
    {
        $this->template->content = '123';
    }

}