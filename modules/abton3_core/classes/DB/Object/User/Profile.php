<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class DB_Object_User_Auth
 */
class DB_Object_User_Profile
{

    /**
     * @var string имя пользователя (например, ФИО)
     */
    protected $_username;

    /**
     * @var string дата рождения
     */
    protected $_birthdate;

    /**
     * @var string контактный телефон
     */
    protected $_phone;

    /**
     * @var string должность
     */
    protected $_occupation;

    /**
     * @var string дополнительная информация о пользователе
     */
    protected $_about;


    /*
     * Get & Set
     */

    public function getUsername()
    {
        return
            Instance_Security::get()->screenString($this->_username);
    }

    public function setUsername($username)
    {
        $this->_username = Instance_Security::get()->screenString($username);
    }

    public function getBirthdate()
    {
        return
            Instance_Security::get()->screenString($this->_birthdate);
    }

    public function setBirthdate($date)
    {
        $this->_birthdate = Instance_Security::get()->screenString($date);
    }

    public function getPhone()
    {
        return
            Instance_Security::get()->screenString($this->_phone);
    }

    public function setPhone($phone)
    {
        $this->_phone = Instance_Security::get()->screenString($phone);
    }

    public function getOccupation()
    {
        return
            Instance_Security::get()->screenString($this->_occupation);
    }

    public function setOccupation($occupation)
    {
        $this->_occupation = Instance_Security::get()->screenString($occupation);
    }

    public function getAbout()
    {
        return
            Instance_Security::get()->screenString($this->_about);
    }

    public function setAbout($about)
    {
        $this->_about = Instance_Security::get()->screenString($about);
    }


    /**
     * Конструктор объекта данных профиля пользователя
     *
     * @param string $username имя пользователя
     * @param string $birthdate имя пользователя
     * @param string $phone телефон пользователя
     * @param string $occupation должность
     * @param string $about дополнительная информация
     */
    function __construct($username = '', $birthdate = '0000-00-00', $phone = '', $occupation = '', $about = '')
    {
        // инциализация
        $this->setUsername($username);
        $this->setBirthdate($birthdate);
        $this->setPhone($phone);
        $this->setOccupation($occupation);
        $this->setAbout($about);
    }

}