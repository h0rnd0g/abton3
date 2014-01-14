<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Instance_Security
 */
class Instance_Security extends Instance {

    /**
     * @var integer название ключа в cookie, где хранится id пользователя после успешной авторизации
     */
    protected $_user_id_cookie = 'user_id';


    /*
     * Функции для работы с флагом установки
     */
    public function isInstalled()
    {
        return
            Kohana::$config->load('security.installed');
    }


    private function setInstalledFlag($state)
    {
        Kohana::$config
            ->load('security')
            ->set('installed', $state)
            ->save();
    }


    public function markInstalled()
    {
        $this->setInstalledFlag(true);
    }


    public function markUninstalled()
    {
        $this->setInstalledFlag(false);
    }


    /**
     * Проверка на соответствие токенов (защита от CSRF-атак)
     *  если нет, то будет выброшен die
     */
    public function checkRequestToken()
    {
        $token_request = $this->getCSRFTokenFromRequest();
        $token_current = $this->getCSRFToken();

        if (!$token_request)
        {
            // если не передали токен в запрос, то скорее всего была произведена CSRF-атака

            $headers_string = print_r(getallheaders(), true); // запекаем шапку запроса
            $post_string = print_r($_POST, true); // запекаем POST-массив

            // выводим в лог предупреждение о запросе без токена + его заголовки + POST-массив
            Log::instance()->add(Log::ERROR,
                'Abton3 CMS :: On Controller_Plugin::action_ajax() : there was an attempt to execute ajax query without token! Here is query\'s headers: '.$headers_string.' '.$post_string
            );

            die(false);
        }
        elseif ( $token_request != $token_current ) // сравниваем токены
        {
            // если токены не равны, то была произведена CSRF-атака

            $headers_string = print_r(getallheaders(), true); // запекаем шапку запроса
            $post_string = print_r($_POST, true); // запекаем POST-массив

            // выводим в лог предупреждение о CSRF  + его заголовки + POST-массив
            Log::instance()->add(Log::WARNING,
                'Abton3 CMS :: On Controller_Plugin::action_ajax() : there was an attempt to execute ajax query with wrong token! Here is query\'s headers: '.$headers_string.' '.$post_string
            );

            die(false);
        }
    }


    /**
     * Записываем CSRF токен
     */
    public function initCSRFToken()
    {
        /*
         * 1) генерируем случайное число
         * 2) хэшуем его указанным в конфиге алгоритмом защиты
         * 3) записываем в текущую сессию пользователя
         */
        Session::instance()->set('csrf_token', hash(Kohana::$config->load('security.hash_method'), rand()));
    }


    /**
     * Получаем CSRF токен
     *
     * @return string текущий токен (false, если его не существует)
     */
    public function getCSRFToken()
    {
        return
            Session::instance()->get('csrf_token', false);
    }

    /**
     * Получаем CSRF токен из запроса
     *
     * @return string текущий токен (false, если его не существует)
     */
    public function getCSRFTokenFromRequest()
    {
        return
            (isset($_POST['token'])) ? $_POST['token'] : false;
    }

    /**
     * Метод генерирует соль для хешей
     *
     * @param $size выходная длина генерируемой соли
     * @param string $chars строка из доступных для генерации символов
     * @return string сгенерированная соль
     */
    private function generateSalt($size, $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?")
    {
        // если длина соли меньше 1 символа, то записываем предупреждение в лог
        if ($size < 1)
        {
            Log::instance()->add(Log::WARNING,
                'Abton3 CMS :: On Instance_Security::generateSalt() : salting is enabled, but it\'s length is < 1, so it has no effect! Check your config/security.php settings!'
            );

            // возвращаем пустую соль
            return
                '';
        }

        $i = 0;
        $salt = "";

        while ($i < $size)
        {
            $salt .= $chars{ mt_rand(0, (strlen($chars) - 1)) };
            $i++;
        }

        return
            $salt;
    }


    /**
     * Хеш-функция системы управления
     *   (прим. алгоритм и другие настройки читаются из конфигурационного файла config/security.php)
     *
     * @param $string входная строка
     * @return string хеш на выходе
     */
    public function hash($string)
    {
        $salt = ''; // по умолчанию соль пуста и не влияет на хеш

        // если соль включена в конфигурационном файле, то генерируем ее
        if (Kohana::$config->load('security.use_salt') === true)
            $salt = $this->generateSalt(
                Kohana::$config->load('security.salt_length'),
                Kohana::$config->load('security.salt_characters'));

        return
            $salt.hash(Kohana::$config->load('security.hash_method'), $salt.$string);
    }


    /**
     * Функция для сравнения пароля с указаным хешем в соответствии с настройками
     *
     * @param string $password пароль, который сравниваем
     * @param string $hash хеш, с которым сравниваем пароль
     * @return bool результат сравнения
     */
    public function comparePassword($password, $hash)
    {
        $salt = '';

        // если соль включена, то достаем ее из хэша (его префикс определенной в конфиге длины)
        if (Kohana::$config->load('security.use_salt') === true)
            $salt = substr($hash, 0, Kohana::$config->load('security.salt_length'));

        // возвращаем результат сравнения
        return
            ($hash == $salt.hash(Kohana::$config->load('security.hash_method'), $salt.$password));
    }


    /**
     * @param bool $remember выбрана ли опция remember при авторизации
     * @return integer длительность хранения Cookie (в секундах)
     */
    public function getCookieExpirationTime($remember = false)
    {
        if ($remember)
            return
                Kohana::$config->load('security.cookie_expiration');
        else
            return
                Kohana::$config->load('security.cookie_expiration_short');
    }


    /**
     * @return integer id пользователя, который авторизован (в таблице auth), иначе false
     */
    public function isAuth()
    {
        return
            Cookie::get($this->_user_id_cookie, false);
    }


    /**
     * Разлогинивает текущего пользователя
     */
    public function logout()
    {
        Cookie::delete($this->_user_id_cookie);
    }


    /**
     * Авторизует пользователя $user
     *
     * @param DB_Object_User_Auth $user
     * @param bool $remember выбрана ли опция remember при авторизации (запомнить меня)
     */
    public function authUser(DB_Object_User_Auth $user, $remember = true)
    {
        $previous_exp = Cookie::$expiration; // запоминаем текущее значение длительности

        // ставим cookie о том, что пользователь авторизован
        Cookie::$expiration = Instance_Security::get()->getCookieExpirationTime($remember); // время хранения cookie
        Cookie::set($this->_user_id_cookie, $user->getID());

        Cookie::$expiration = $previous_exp; // восстанавливаем запомненное значение
    }


    /*
     * Инициализация
     */
    protected function __construct() {}

    // -- реализация синглтона -------------------------------------------

    /**
     * @var Instance
     */
    private static $_instance;

    final private function __clone() { }

    /*
     * @return Instance_Security
     */
    public static function get()
    {
        // если переменная пуста...
        if (null === self::$_instance)
            // ...то создаем объект класса
            self::$_instance = new self();

        return
            self::$_instance;
    }

}