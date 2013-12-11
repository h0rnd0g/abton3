<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Plugin
 *   Базовый контроллер плагинов системы
 */
class Controller_Plugin extends Controller_Template {

    public $template = 'messages';

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
    }

    public function action_index()
    {

    }

}