<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Login
 *   Контроллер, который описывает логику работы ядра с запросами
 *   касательно авторизации, блокировки интерфейса, выхода и т.д.
 */
class Controller_Login extends Controller_Depended {

    public $template = 'template_login';

    /**
     * Страница авторизации
     */
    public function action_index()
    {
//        DB_Model_Auth::get()->dropTables();
//        DB_Model_Auth::get()->createTables();

//        $profile = new DB_Object_User_Profile('Serhiy', '1992-01-01', '717021', 'developer');
//        DB_Model_Auth::get()->getMapperInstance()->addUserAuth($user);

//        $user = DB_Model_Auth::get()->getMapperInstance()->getUserAuthByID(1);
//        $user->getProfile();
//
//        $user->getProfile()->setAbout('here is about2');
//
//        DB_Model_Auth::get()->getMapperInstance()->saveUserAuth($user);
//
//        throw new Exception(var_dump($user));

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
            $remember = isset($post['remember']);

            // получаем пользователя с указанным логином
            $user = DB_Model_Auth::get()->getMapperInstance()->getUserAuthByLogin($login);

            // проверка: найден ли пользователь (идентификация)
            if ($user)
            {
                // сверяем введенный пароль и хэш найденного пользователя
                if (Instance_Security::get()->comparePassword($password, $user->getHash()))
                {
                    // аутентификация успешна!
                    Instance_Security::get()->authUser($user, $remember);

                    // если был сохранен в сессии запрашиваемый uri до переадресации на страницу авторизации...
                    if ($request_uri = Session::instance()->get('request_uri', false))
                    {
                        Session::instance()->delete('request_uri'); // очищаем переменную предыдущего запроса в сессии
                        $this->redirect($request_uri); // делаем редирект по предыдущему запросу (до авторизации)
                    }
                    else
                    {
                        Instance_Routing::get()->abtonRedirect(); // делаем редирект на стартовую
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
    }


    /**
     * Редиректы
     */
    public function action_redirect()
    {
        // если авторизованы
        if (Instance_Security::get()->isAuth())
        {
            Instance_Routing::get()->abtonRedirect(); // то редиректим в корень (на стартовую)
        }
        else
        {
            // иначе редиректим на страницу авторизации
            Instance_Routing::get()->abtonRedirect('login');
        }
    }

}