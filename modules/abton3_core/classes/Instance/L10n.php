<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Instance_L10n
 */
class Instance_L10n extends Instance {

    const ERROR_LANGUAGE_DOESNT_EXISTS = 1;

    /**
     * @var Текущий язык
     */
    private static $_language;

    /*
     * @return $_language
     */
    public function getLanguage()
    {
        return
            self::$_language;
    }

    public function setLanguage($language)
    {
        // получаем массив доступных языков из файла конфигураций
        $available = Kohana::$config->load('l10n.available_languages');

        // если языка не существует в массиве доступных...
        if (!array_key_exists($language, $available))
        {
            // ... записываем в лог
            Log::instance()->add(Log::WARNING, 'Abton3 CMS :: On Instance_L10n::setLanguage() : language \':lng\' doesnt exist!', array(
                ':lng' => $language,
            ));

            // выбрасываем ошибку
            throw new Exception("Language '$language' doesnt exist!", self::ERROR_LANGUAGE_DOESNT_EXISTS);
        }

        self::$_language = $language;
    }

    /**
     * Возвращает массив языковых констант для текущего языка из указанного файла
     *
     * @param string $config_name имя файла (или относительный путь к нему) в папке config/l10n
     * @return array массив языковых констант
     */
    public function getConstantsArray($config_name)
    {
        return
            Kohana::$config->load('l10n/'.$config_name.'.'.self::$_language);
    }

    /*
     * Инициализация
     */
    protected function __construct()
    {
        // инициализируем текущий язык значением по умолчанию из файла конфигурации
        self::$_language = Kohana::$config->load('l10n.default_language');
    }

    // -- реализация синглтона -------------------------------------------

    /**
     * @var Instance
     */
    private static $_instance;

    final private function __clone() { }

    /*
     * @return Instance_L10n
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