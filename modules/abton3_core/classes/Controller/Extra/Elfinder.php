<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Extra_Elfinder
 */
class Controller_Extra_Elfinder extends Controller {

    /*
     * Выполняется перед вызовом action'а
     * Содержит в себе проверку на авторизацию
     */
    public function before()
    {
        parent::before();

        // пробуем получить user_id и если пользователь не авторизован
        if ( !($user_id = Instance_Security::get()->isAuth()) )
        {
            // die
            die('Access denied!');
        }
    }

    public function action_index()
    {
        $view = View::factory('extra/elfinder');

        $this->response->body($view);
    }

}