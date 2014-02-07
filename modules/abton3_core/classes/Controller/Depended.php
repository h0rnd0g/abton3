<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Depended
 *   Промежуточный класс контроллеров, которые зависимы от необходимости системы управления
 *   быть установленной
 */
class Controller_Depended extends Controller_Base {

    /**
     * Выполняется перед вызовом action'а
     * Содержит в себе на то, установлена ли система
     */
    public function before()
    {
        parent::before();

        // проверка на установку
        if (!Instance_Security::get()->isInstalled())
        {
            // если не установлена, то делаем переадресацию на страницу инсталяции
            Instance_Routing::get()->abtonRedirect('install');
        }
    }

}