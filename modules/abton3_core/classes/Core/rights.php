<?php defined('SYSPATH') or die('No direct script access.');

// TODO прокоментувати

/**
 * Class Core_Rights
 *
 * @author     Serhiy "deus krid" Yaniuk
 * @copyright  (c) 2013 deus krid
 */
class Core_Rights
{

    public static function getUserGroup($user_id)
    {
        $model = new Model_Auth();

        return
            $model->getUserGroup($user_id);
    }

    public static function groupExists($group)
    {
        $rights = Core_Abton2::getParam('rights.groups');

        return
            array_key_exists($group, $rights);
    }

    public static function hasPluginRights($plugin_name)
    {
        $user_id = Session::instance()->get('abton_user_id');

        $user_group = Core_Rights::getUserGroup($user_id);

        if ($user_group == 0)
            return
                true; // якщо у користувача группа 0, то право є завжди (root)

        $rights = Core_Abton2::getParam('rights.groups');

        if (!Core_Rights::groupExists($user_group))
            return
                false; // якщо такої групи прав не існує, то у користувача немає прав (guest)

        $group = $rights[$user_group];
        $plugins = $group['plugins'];

        if (array_key_exists($plugin_name, $plugins))
            return
                $plugins[$plugin_name];
        else
            return
                false;
    }

    public static function hasRights($plugin_name, $rights_name)
    {
        $plugin_rights = Core_Rights::hasPluginRights($plugin_name);

        if ($plugin_rights === false)
            return
                false; // прав немає, якщо вони не задані для цього плагіну

        if ($plugin_rights === true)
            return
                true; // це супер-юзер!

        /*
            інакше повернено масив із правами цієї групи,
            а отже потрібно повертати значення відповідного ключа
            (якщо він існує)
        */
        
        if (!array_key_exists($rights_name, $plugin_rights))
            return
                false; // прав немає, якщо не існує відповідного ключа в списку прав плагіна для групи

        return
            $plugin_rights[$rights_name];
    }

}