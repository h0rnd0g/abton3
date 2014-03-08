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
//                'static' => array(
//                    'icon' => '',
//                    'path' => 'static',
//                ),
            );
    }

    protected function parseUpdateSrt($node)
    {
        foreach ($node as $key => $item)
        {
            DB_Model_Navigation::get()->getMapperInstance()->changeSrtByID($item['id'], $key);

            if (array_key_exists('children', $item))
                $this->parseUpdateSrt($item['children']);
        }
    }

    public function action_ajax()
    {
        parent::action_ajax();

        try
        {
            $success_data = array();
            $type = $this->request->post('type');

            if ($type == 'get_menu_group')
            {
                $group_id = $this->request->post('group_id');
                //$parent_id = $this->request->post('parent_id');

                $success_data['menu'] = DB_Model_Navigation::get()->getMapperInstance()->getMenuTree($group_id);
            }
            elseif ($type == 'move_menu')
            {
                $id = $this->request->post('menu_id');
                $new_sub = $this->request->post('new_sub');

                DB_Model_Navigation::get()->getMapperInstance()->changeSubByID($id, $new_sub);
            }
            elseif ($type == 'update_srt')
            {
                $tree = $this->request->post('tree');

                $this->parseUpdateSrt($tree);
            }
            elseif ($type == 'add_page')
            {
                // читаем данные из запроса
                $title = $this->request->post('title');
                $title2 = $this->request->post('title2');
                $pref = $this->request->post('pref');
                $content = $this->request->post('content');
                $seo_description = $this->request->post('seo_description');
                $seo_keywords = $this->request->post('seo_keywords');

                DB_Model_Navigation::get()->getMapperInstance()->addNavigationEl($title, $title2, $pref, $content, $seo_keywords, $seo_description);
            }
            elseif ($type == 'delete_page')
            {
                $id = $this->request->post('page_id');

                DB_Model_Navigation::get()->getMapperInstance()->deleteNavigationEl($id);
            }
            elseif ($type == 'edit_page')
            {
                $id = $this->request->post('el_id');
                $title = $this->request->post('title');
                $page_title = $this->request->post('page_title');
                $pref = $this->request->post('pref');
                $content = $this->request->post('content');
                $seo_description = $this->request->post('seo_description');
                $seo_keywords = $this->request->post('seo_keywords');

                DB_Model_Navigation::get()->getMapperInstance()->saveNavigationEl($id, $title, $page_title, $pref, $content, $seo_keywords, $seo_description);
            }

            Instance_Security::get()->ajaxResponse(true, $success_data);
        }
        catch (Exception $e)
        {
            //Instance_Security::get()->ajaxResponse(false);
            throw new Exception($e->getMessage());
        }
    }

    public function formJsAndCSS()
    {
        // подключаем nestable (древовидный список)
        $this->style('/assets/plugins/jquery-nestable/jquery.nestable.css');
        $this->script('/assets/plugins/jquery-nestable/jquery.nestable.js');

        // подключаем CK Editor
        $this->script('/assets/plugins/ckeditor/ckeditor.js');
    }

    // базовый метод
    public function action_index()
    {
        $view = View::factory('navigation/menu');

        $this->template->content = $view;
    }

    public function action_static()
    {
        $this->template->content = '123';
    }

}