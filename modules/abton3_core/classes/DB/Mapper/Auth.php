<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class DB_Mapper_Auth
 */
class DB_Mapper_Auth extends DB_Mapper
{

    /**
     * Создаем таблицы для системного модуля авторизации
     */
    public function createTables()
    {
        /*
         * получаем данные из конфигурационного файла,
         * необходимые для определения размера поля hash таблицы авторизации
         *
         * длина поля hash = длина соли + длина хэша на выходе используемого алгоритма
         */
        $hash_length = Kohana::$config->load('security.salt_length') + Kohana::$config->load('security.hash_length');

        // запрос на создание таблицы auth
        $sql_create =
            "CREATE TABLE IF NOT EXISTS {$this->_tables['auth']} (
                id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'PK',
                login varchar(20) NOT NULL COMMENT 'user login to authorize in system',
                hash char($hash_length) NOT NULL COMMENT 'hash of user password',
                email varchar(50) NOT NULL COMMENT 'email linked to user account (they can restore password with this email)',
                added TIMESTAMP DEFAULT now() COMMENT 'when user was created',
                UNIQUE(login),
                UNIQUE(email)
            ) CHARACTER SET utf8 COLLATE utf8_general_ci, engine=InnoDB;";

        DB::query(null, $sql_create)
            ->execute();
    }


    public function getUserAuthByID($id)
    {

    }


    public function getUserAuthByLogin($login)
    {
        // запрос
        $user_raw = DB::select()
            ->from($this->_tables['auth'])
            ->where('login', '=', $login)
            ->execute()
            ->as_array();

        // проверка: найден ли пользователь
        if ($user_raw)
        {
            // создаем пользователя
            $user = new DB_Object_User_Auth(
                $user_raw[0]['id'],
                $user_raw[0]['login'],
                $user_raw[0]['hash'],
                $user_raw[0]['email'],
                $user_raw[0]['added'],
                true // указываем, что передаем хэш в конструктор, а не пароль (хэширование аргумента $password не нужно)
            );

            // и возвращаем его
            return
                $user;
        }

        // если такой логин не найдет, то возвращаем null
        return
            null;
    }


    public function saveUserAuth(DB_Object_User_Auth $user)
    {

    }


    /**
     * Метод маппера добавляет в таблицу auth объект $user
     *
     * @param DB_Object_User_Auth $user объект данных авторизации пользователя
     */
    public function addUserAuth(DB_Object_User_Auth $user)
    {
        // запрос на вставку в таблицу записи о объекте $user
        $query = DB::insert($this->_tables['auth'], array('login', 'hash', 'email'))
            ->values(
                array(
                    $user->getLogin(),
                    $user->getHash(),
                    $user->getEmail()
                )
            );

        // если ID задан явно, то указываем его в запросе (иначе СУБД подставит значение по умолчанию - AUTO_INCREMENT)
        if ($user->getID() != DB_Object::PK_AUTO_INCREMENT)
            $query->set('id', $user->getID());

        // если дата задана явно, то указываем ее в запросе (иначе СУБД подставит значение по умолчанию - NOW() )
        if ($user->getAdded() != DB_Object::TIMESTAMP_NOW)
            $query->set('added', $user->getAdded());

        try
        {
            $query->execute();

            return
                DB_Mapper::SUCCESS;
        }
        catch (Database_Exception $e)
        {
            /*
             * Если ошибка, то парсим ее штатным методом маппера и возвращаем его результат
             */

            return
                $this->parseDatabaseException($e);
        }
    }

}