<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Instance_Security
 */
class Instance_Security extends Instance {

    /**
     * @var integer название ключа в cookie, где хранится id пользователя после успешной авторизации
     */
    protected $_user_id_cookie = 'user_id';

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
     * @return integer длительность хранения Cookie (в секундах)
     */
    public function getCookieExpirationTime()
    {
        return
            Kohana::$config->load('security.cookie_expiration');
    }


    /**
     * @return integer id пользователя, который авторизован (в таблице auth)
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
     */
    public function authUser(DB_Object_User_Auth $user)
    {
        Cookie::set($this->_user_id_cookie, $user->getID());
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