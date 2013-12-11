<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Login
 *   Контроллер, который описывает логику работы ядра с запросами
 *   касательно авторизации, блокировки интерфейса, выхода и т.д.
 */
class Controller_Login extends Controller_Base {

    public $template = 'template_login';

    /**
     * Страница авторизации
     */
    public function action_index()
    {
        // удаляем cookie про авторизацию
        Instance_Security::get()->logout();

        // получаем массив локализации
        $lang_array = Instance_L10n::get()->getConstantsArray('login_page');

        // получаем данные из POST
        $post = $this->request->post();

        if (isset($post['auth_login'])) // если есть запрос на авторизацию
        {
            // получаем информацию о авторизации
            $login = $post['auth_login'];
            $password = $post['auth_password'];
            $remember = $post['remember'];

            // получаем пользователя с указанным логином
            $user = DB_Model_Auth::get()->getMapperInstance()->getUserAuthByLogin($login);

            // проверка: найден ли пользователь (идентификация)
            if ($user)
            {
                // сверяем введенный пароль и хэш найденного пользователя
                if (Instance_Security::get()->comparePassword($password, $user->getHash()))
                {
                    // аутентификация успешна!
                    Instance_Security::get()->authUser($user);

                    // если был сохранен в сессии запрашиваемый uri до переадресации на страницу авторизации...
                    if ($request_uri = Session::instance()->get('request_uri', false))
                    {
                        //throw new Exception($request_uri);
                        Session::instance()->delete('request_uri'); // очищаем переменную предыдущего запроса в сессии
                        $this->redirect($request_uri); // делаем редирект по предыдущему запросу (до авторизации)
                    }
                    else
                    {
                        $this->abtonRedirect('/start_page'); // делаем редирект на стартовую
                    }
                }
                else
                {
                    // неверный пароль
                    Instance_Messages::get()->addMessage(Instance_Messages::MESSAGE_ERROR, $lang_array['login_error_auth_title'], $lang_array['login_error_auth_description']);
                }
            }
            else
            {
                // в системе нету пользователя с таким логином (сообщение выводим тоже - отсутствие конкретики в ошибке для безопасности)
                Instance_Messages::get()->addMessage(Instance_Messages::MESSAGE_ERROR, $lang_array['login_error_auth_title'], $lang_array['login_error_auth_description']);
            }
        }

        /*
         * Передача данных к шаблону
         */
        $this->template->lang_array = $lang_array;

        // TODO: помнить адреса реквестов и редиректить в случае чего!
    }


    /**
     * Редиректы
     */
    public function action_redirect()
    {
        // если авторизованы
        if (Instance_Security::get()->isAuth())
        {
            $this->abtonRedirect('/start_page');
        }
        else
        {
            $this->abtonRedirect('/login');
        }
    }

}