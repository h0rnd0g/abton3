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
            $this->_username;
    }

    public function setUsername($username)
    {
        $this->_username = $username;
    }

    public function getBirthdate()
    {
        return
            $this->_birthdate;
    }

    public function setBirthdate($date)
    {
        $this->_birthdate = $date;
    }

    public function getPhone()
    {
        return
            $this->_phone;
    }

    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    public function getOccupation()
    {
        return
            $this->_occupation;
    }

    public function setOccupation($occupation)
    {
        $this->_occupation = $occupation;
    }

    public function getAbout()
    {
        return
            $this->_about;
    }

    public function setAbout($about)
    {
        $this->_about = $about;
    }


    /**
     * Конструктор объекта данных профиля пользователя
     *
     * @param string $username имя пользователя
     * @param string $phone телефон пользователя
     * @param string $occupation должность
     * @param string $about дополнительная информация
     */
    function __construct($username = '', $birthdate = '0000-00-00', $phone = '', $occupation = '', $about = '')
    {
        // инциализация
        $this->_username = $username;
        $this->_birthdate = $birthdate;
        $this->_phone = $phone;
        $this->_occupation = $occupation;
        $this->_about = $about;
    }

}