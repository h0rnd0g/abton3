<?php defined('SYSPATH') or die('No direct script access.');

// TODO закінчити клас

/**
 * Core_Notification
 *
 * @author     Serhiy "deus krid" Yaniuk
 * @copyright  (c) 2013 deus krid
 */
class Core_Notification
{
    private static $notes = array();

    public static function add($name)
    {
        self::$notes[] = $name;
    }

    public static function getNotifications()
    {
        $res = array();
        $l10n = Core_Abton2::getLanguageArray('localization');

        foreach (self::$notes as $note)
        {
            $res[] = array(
                'title' => $l10n[$note.'_title'],
                'desc' => $l10n[$note.'_desc'],
            );
        }

        return
            $res;
    }

}
