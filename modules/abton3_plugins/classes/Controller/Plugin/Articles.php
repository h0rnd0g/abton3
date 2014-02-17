<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Plugin_Dummy
 *   Плагин-пустышка (для тестов)
 */
class Controller_Plugin_Articles extends Controller_Plugin {

    public static function getMenuTree()
    {
        return
            array(
                'index' => array(
                    'icon' => 'file',
                    'path' => '',
                ),
            );
    }

    public function formJsAndCSS()
    {
        // подключаем CK Editor
        $this->script('/assets/plugins/ckeditor/ckeditor.js');
    }

    // базовый метод
    public function action_index()
    {
        $view = View::factory('articles/list');

        $this->template->content = $view;
    }

}