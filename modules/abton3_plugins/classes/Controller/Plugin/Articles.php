<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Plugin_Articles
 *   Плагин материалов
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

    public function action_ajax()
    {
        parent::action_ajax();

//        if ($this->request->post('type') == 'get_articles')
//        {
//            $this->response->body('ololololo');
//        }

        $this->response->body($this->request->post('type'));
    }

    public function formJsAndCSS()
    {
        // подключаем CK Editor
        $this->script('/assets/plugins/ckeditor/ckeditor.js');
    }

    // базовый метод
    public function action_index()
    {
        //DB_Model_Articles::get()->getMapperInstance()->createTables();

        $view = View::factory('articles/list');

        $this->template->content = $view;
    }

}