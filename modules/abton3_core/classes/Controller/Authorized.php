<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Authorized
 *   Базовый контроллер всех страниц системы (системные, плагины, личный кабинет и т.п.)
 *   Содержит проверку на авторизацию
 */
class Controller_Authorized extends Controller_Depended {

    /**
     * @var string название вида шаблона для всех страниц внутри системы
     */
    public $template = 'template_index';

    /**
     * @var объект DB_Object_Auth, если пользователь авторизован
     */
    protected $_user = null;

    /*
     * Выполняется перед вызовом action'а
     * Содержит в себе проверку на авторизацию + подключение базовых данных шаблона + некоторые меры безопасности
     */
    public function before()
    {
        parent::before();

        // пробуем получить user_id и если пользователь не авторизован
        if ( !($user_id = Instance_Security::get()->isAuth()) )
        {
            Session::instance()->set('request_uri', $_SERVER['REQUEST_URI']); // записываем запрашиваемый им адрес
            Instance_Routing::get()->abtonRedirect('login');
        }

        /*
         * если пользователь авторизован, то редиректа не будет и секция кода ниже будет выполняться
         */

        // читаем из базы пользователя и сохраняем в поле контроллера
        $core_model = Data_Factory::model('core');
        $this->_user = $core_model->getUserByID($user_id);
        View::set_global('user', $this->_user); // делаем глобальным для всех видов и шаблонов

        /*
         * передача данных шаблону
         */

        // передаем массив языковых констант шаблона
        $template_lang_array = Instance_L10n::get()->getConstantsArray('index_page');
        $this->template->template_array = $template_lang_array;

        // передаем дерево меню
        $this->template->menu = Instance_Plugins::get()->getMenu();

        /*
         * защита ajax (токен для предотвращения CSRF атак)
         *
         *  для каждой страницы мы генерируем новый токен
         */
        Instance_Security::get()->initCSRFToken();
    }

}