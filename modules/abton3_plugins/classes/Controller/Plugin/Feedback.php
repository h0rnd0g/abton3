<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Plugin_Dummy
 *   Плагин-пустышка (для тестов)
 */
class Controller_Plugin_Feedback extends Controller_Plugin {

    public static function getMenuTree()
    {
        return
            array(
                'index' => array(
                    'icon' => 'envelope',
                    'path' => '',
                ),
            );
    }

    // базовый метод
    public function action_index()
    {
        //DB_Model_Navigation::get()->getMapperInstance()->createTables();
        $view = View::factory('feedback/guestbook');

        $this->template->content = $view;
    }

}