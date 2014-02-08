<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class DB_Object_User_Auth
 */
class DB_Object_User_Auth extends DB_Object
{

    /**
     * @var string логин пользователя
     */
    protected $_login;

    /**
     * @var string хэш пароля пользователя
     */
    protected $_hash;

    /**
     * @var string email пользователя
     */
    protected $_email;

    /**
     * @var string дата добавления пользователя (timestamp)
     */
    protected $_added;

    /**
     * @var DB_Object_User_Profile профиль пользователя
     */
    protected $_profile;


    /*
     * Get & Set
     */

    public function getLogin()
    {
        return
            $this->_login;
    }

    public function setLogin($login)
    {
        $validator = Validation::factory(array('login' => $login))
            ->rule('login', 'not_empty')
            ->rule('login', 'regex', array(':value', '/^[a-z_.]++$/iD'));

        if ($validator->check())
            $this->_login = $login;
        else
        {
            throw new Validation_Exception($validator);
        }
    }

    public function getHash()
    {
        return
            $this->_hash;
    }

    public function setPassword($password)
    {
        $this->_hash = Instance_Security::get()->hash($password);
    }

    public function getEmail()
    {
        return
            $this->_email;
    }

    public function setAdded($added)
    {
        $this->_added = $added;
    }

    public function getAdded()
    {
        return
            $this->_added;
    }

    public function _getProfile()
    {
        return
            $this->_profile;
    }

    public function getProfile()
    {
        // AUTOLOAD: если профиль не указан, то пробуем подгрузить его из базы
        if ($this->_profile == null)
            $this->_profile = DB_Model_Auth::get()->getMapperInstance()->getUserAuthProfileByID($this->_id);

        return
            $this->_profile;
    }

    public function setProfile(DB_Object_User_Profile $profile)
    {
        $this->_profile = $profile;
    }

    public function getRepresentativeName()
    {
        $profile = $this->getProfile();

        if ($profile->getUsername() != '')
            return
                $profile->getUsername();

        return
            $this->_login;
    }

    /**
     * Конструктор объекта данных авторизации пользователя
     *
     * @param integer $id PK
     * @param string $login логин пользователя
     * @param string $password пароль пользователя (не хэш!)
     * @param string $email email пользователя
     * @param string $added дата добавления пользователя (timestamp)
     * @param bool $password_as_hash если true, то от пароля не будет браться хэш (передается напрямую)
     * @param DB_Object_User_Profile $profile объект профиля пользователя
     */
    function __construct($id, $login, $password, $email, $added, $password_as_hash = false, DB_Object_User_Profile $profile = null)
    {
        // инциализация
        $this->_email = $email;
        $this->_profile = $profile;

        // если в $password уже хешированный пароль
        if ($password_as_hash)
            $this->_hash = $password; // то записываем его напрямую
        else
            $this->setPassword($password);

        $this->setLogin($login);
        $this->setAdded($added);

        // вызываем конструктор предка
        parent::__construct($id);
    }

}