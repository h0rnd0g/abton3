<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Class Data_Core_Model
 */
class Data_Core_Mapper_SQL extends Data_Core_Mapper {

    protected $tables = array(
        'right_groups' => 'core_right_groups',
        'right_group_attributes' => 'core_right_group_attributes',
        'users' => 'core_users',
        'profiles' => 'core_profiles',
        'temp_links' => 'core_temp_links'
    );

    public function install()
    {
        $query_create_right_groups = DB::query(0,
            "CREATE TABLE IF NOT EXISTS `{$this->tables['right_groups']}` (
              `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
              `name` VARCHAR(45) NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE INDEX `name_UNIQUE` (`name` ASC))
              ENGINE = InnoDB;"
        );

        $query_create_core_users = DB::query(0,
            "CREATE TABLE IF NOT EXISTS `{$this->tables['users']}` (
              `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
              `login` VARCHAR(45) NOT NULL,
              `hash` CHAR(255) NOT NULL,
              `email` VARCHAR(100) NOT NULL,
              `core_right_groups_id` INT UNSIGNED,
              PRIMARY KEY (`id`),
              UNIQUE INDEX `login_UNIQUE` (`login` ASC),
              UNIQUE INDEX `hash_UNIQUE` (`hash` ASC),
              INDEX `fk_{$this->tables['users']}_core_right_groups1_idx` (`core_right_groups_id` ASC),
              CONSTRAINT `fk_{$this->tables['users']}_core_right_groups1`
                FOREIGN KEY (`core_right_groups_id`)
                REFERENCES `{$this->tables['right_groups']}` (`id`)
                ON DELETE SET NULL
                ON UPDATE RESTRICT)
              ENGINE = InnoDB;"
        );

        $query_create_core_profiles = DB::query(0,
            "CREATE TABLE IF NOT EXISTS `{$this->tables['profiles']}` (
              `core_users_id` INT UNSIGNED NOT NULL,
              `name` VARCHAR(100) NULL,
              `occupation` VARCHAR(100) NULL,
              `description` VARCHAR(1000) NULL,
              `phone` CHAR(13) NULL,
              `birthdate` DATE NULL,
              `avatar` VARCHAR(255) NULL,
              PRIMARY KEY (`core_users_id`),
              INDEX `fk_{$this->tables['profiles']}_core_users_idx` (`core_users_id` ASC),
              CONSTRAINT `fk_{$this->tables['profiles']}_core_users`
                FOREIGN KEY (`core_users_id`)
                REFERENCES `{$this->tables['users']}` (`id`)
                ON DELETE CASCADE
                ON UPDATE RESTRICT)
              ENGINE = InnoDB;"
        );

        $query_create_core_temp_links = DB::query(0,
            "CREATE TABLE IF NOT EXISTS `{$this->tables['temp_links']}` (
              `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
              `added` TIMESTAMP NOT NULL,
              `access_code` CHAR(128) NOT NULL,
              `core_users_id` INT UNSIGNED NOT NULL,
              PRIMARY KEY (`id`),
              INDEX `fk_{$this->tables['temp_links']}_core_users1_idx` (`core_users_id` ASC),
              UNIQUE INDEX `core_users_id_UNIQUE` (`core_users_id` ASC),
              UNIQUE INDEX `access_code_UNIQUE` (`access_code` ASC),
              CONSTRAINT `fk_{$this->tables['temp_links']}_core_users1`
                FOREIGN KEY (`core_users_id`)
                REFERENCES `{$this->tables['users']}` (`id`)
                ON DELETE CASCADE
                ON UPDATE RESTRICT)
              ENGINE = InnoDB;"
        );

        $query_create_core_right_group_attributes = DB::query(0,
            "CREATE TABLE IF NOT EXISTS `{$this->tables['right_group_attributes']}` (
                `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `key` VARCHAR(100) NULL,
                `core_right_groups_id` INT UNSIGNED NOT NULL,
                PRIMARY KEY (`id`),
                INDEX `fk_{$this->tables['right_group_attributes']}_core_right_groups1_idx` (`core_right_groups_id` ASC),
                CONSTRAINT `fk_{$this->tables['right_group_attributes']}_core_right_groups1`
                  FOREIGN KEY (`core_right_groups_id`)
                  REFERENCES `{$this->tables['right_groups']}` (`id`)
                  ON DELETE CASCADE
                  ON UPDATE RESTRICT)
                ENGINE = InnoDB;"
        );

        try
        {
            Helper_Database_SQL::transactionStart();

                // выполняем запросы внутри транзакции
                $query_create_right_groups->execute();
                $query_create_core_users->execute();
                $query_create_core_profiles->execute();
                $query_create_core_temp_links->execute();
                $query_create_core_right_group_attributes->execute();

            Helper_Database_SQL::transactionCommit();
        }
        catch (Database_Exception $e)
        {
            /*
             * ПРИМЕЧАНИЕ
             *
             * Да, мне известно, что в MySQL транзакции для DDL-запросов не поддерживаются.
             * Но! Если такая поддержка появится - все уже сделано :)
             *
             * До тех пор также отсюда будет выполняться удаление таблиц (тех, что мы успели создать)
             */

            // откат де-юре
            Helper_Database_SQL::transactionRollback();

            // откат де-факто
            $this->uninstall();

            throw $e;
        }

        return
            parent::install();
    }

    public function uninstall()
    {
        $query_drop_right_groups = DB::query(0,
            "DROP TABLE IF EXISTS `{$this->tables['right_groups']}`"
        );

        $query_drop_core_users = DB::query(0,
            "DROP TABLE IF EXISTS `{$this->tables['users']}`"
        );

        $query_drop_core_profiles = DB::query(0,
            "DROP TABLE IF EXISTS `{$this->tables['profiles']}`"
        );

        $query_drop_core_temp_links = DB::query(0,
            "DROP TABLE IF EXISTS `{$this->tables['temp_links']}`"
        );

        $query_drop_core_right_group_attributes = DB::query(0,
            "DROP TABLE IF EXISTS `{$this->tables['right_group_attributes']}`"
        );

        $query_drop_trigger_core_rights = DB::query(0,
            "DROP TABLE IF EXISTS `core_right_groups_BDEL`");

        try
        {
            Helper_Database_SQL::transactionStart();

            // выполняем запросы внутри транзакции
            $query_drop_core_right_group_attributes->execute();
            $query_drop_core_temp_links->execute();
            $query_drop_core_profiles->execute();
            $query_drop_core_users->execute();
            $query_drop_right_groups->execute();

            Helper_Database_SQL::transactionCommit();
        }
        catch (Database_Exception $e)
        {
            Helper_Database_SQL::transactionRollback();

            throw $e;
        }

        return
            parent::install();
    }

    public function addUser(Data_Core_Object_User $user)
    {
        try
        {
            Helper_Database_SQL::transactionStart();

            $query_insert_user = DB::insert($this->tables['users'], $user->formRawKeys())
                ->values($user->formRawValues());

            $response = $query_insert_user->execute();
            $id = $response[0];

            if (isset($user->profile))
                $profile = $user->profile;
            else
                $profile = Data_Core_Object_Profile::create();

            $profile->core_users_id = $id;
            $query_insert_profile = DB::insert($this->tables['profiles'], $profile->formRawKeys())
                ->values($profile->formRawValues());

            $query_insert_profile->execute();

            Helper_Database_SQL::transactionCommit();
        }
        catch (Exception $e)
        {
            Helper_Database_SQL::transactionRollback();

            throw $e;
        }
    }

    public function getUserByLogin($login)
    {
        $query_select_user = DB::select()
            ->from($this->tables['users'])
            ->where('login', '=', $login)
            ->limit(1);

        $user_raw = $query_select_user
            ->execute()
            ->as_array();

        if (!count($user_raw))
            return
                false;

        $user = Data_Core_Object_User::create($user_raw[0]);

        return
            $user;
    }

    public function getUserByID($id)
    {
        $query_select_user = DB::select()
            ->from($this->tables['users'])
            ->where('id', '=', $id)
            ->limit(1);

        $user_raw = $query_select_user
            ->execute()
            ->as_array();

        if (!count($user_raw))
            return
                null;

        $user = Data_Core_Object_User::create($user_raw[0]);

        return
            $user;
    }

    public function getProfileByID($id)
    {
        $query_select_profile = DB::select()
            ->from($this->tables['profiles'])
            ->where('core_users_id', '=', $id)
            ->limit(1);

        $profile_raw = $query_select_profile
            ->execute()
            ->as_array();

        if (!count($profile_raw))
            return
                null;

        $profile = Data_Core_Object_Profile::create($profile_raw[0]);

        return
            $profile;
    }

}