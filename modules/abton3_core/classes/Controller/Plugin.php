<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Plugin
 *   Базовый контроллер плагинов системы
 */
class Controller_Plugin extends Controller_Template {

    public $template = 'template_index';

    /*
     * Выполняется перед вызовом action'а
     */
    public function before()
    {
        parent::before();

        // если пользователь не авторизован
        if (!Instance_Security::get()->isAuth())
        {
            Session::instance()->set('request_uri', $_SERVER['REQUEST_URI']); // записываем запрашиваемый им адрес
            $this->abtonRedirect('/login'); // редиректим на страницу авторизации
        }

        $template_lang_array = Instance_L10n::get()->getConstantsArray('index_page');
        $this->template->template_array = $template_lang_array;
    }

    public function action_index()
    {

    }

}