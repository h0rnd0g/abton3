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

    public function before()
    {
        $this->style('/assets/plugins/data-tables/DT_bootstrap.css');
        $this->script('/assets/plugins/select2/select2.min.js');
        $this->script('/assets/plugins/data-tables/jquery.dataTables.js');
        $this->script('/assets/plugins/data-tables/DT_bootstrap.js');

        parent::before();
    }

    public function action_ajax()
    {
        parent::action_ajax();

        try
        {
            $success_data = array();
            $type = $this->request->post('type');

            if ($type == 'get_locales')
            {
                $locales = Model_Plugin_Locale::getLocales();

                $success_data['locales'] = $locales;
            }

            Instance_Security::get()->ajaxResponse(true, $success_data);
        }
        catch (Exception $e)
        {
            Instance_Security::get()->ajaxResponse(false, array('msg' => $e->getMessage(), 'code' => $e->getCode()));
        }
    }

    public function action_index()
    {
        $this->template->content = View::factory('locale/locales');
    }

    public function action_vars()
    {
        $this->template->content = '321';
    }

}