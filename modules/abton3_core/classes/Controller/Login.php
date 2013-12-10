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

            // проверка: найден ли пользователь
            if ($user)
            {
                // сверяем введенный пароль и хэш найденного пользователя
                if (Instance_Security::get()->comparePassword($password, $user->getHash()))
                {
                    // аутентификация успешна!
                    Instance_Messages::get()->addMessage(Instance_Messages::MESSAGE_SUCCESS, 'Успех', 'Авторизация прошла успешно');
                }
                else
                {
                    // неверный пароль
                    Instance_Messages::get()->addMessage(Instance_Messages::MESSAGE_ERROR, 'Ошибка авторизации', 'Пароли не совпадают');
                }
            }
            else
            {
                // в системе нету пользователя с таким логином
                Instance_Messages::get()->addMessage(Instance_Messages::MESSAGE_ERROR, 'Ошибка авторизации', 'Такого пользователя не существует');
            }
        }

        /*
         * Передача данных к шаблону
         */
        $lang_array = Instance_L10n::get()->getConstantsArray('login_page');
        $this->template->lang_array = $lang_array;
    }


    /**
     * Редиректы
     */
    public function action_redirect()
    {
        $user_id = Session::instance()->get('a3_user_id', false);

        if ($user_id !== false)
        {

        }
        else
        {
            $this->abtonRedirect('/login');
        }
    }

}