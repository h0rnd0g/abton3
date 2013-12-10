<?php defined('SYSPATH') OR die('No direct script access.');

/*
 * Controller
 *   Расширение базового класса Kohana_Controller фреймворка Kohana
 */
abstract class Controller extends Kohana_Controller {

    /*
     * Редирект внутри системы управления
     */
    public function abtonRedirect($path, $lang = null)
    {
        // редирект относительно пути $path сгенериурет весь путь с префиксом системы управления и текущим языком

        if (!isset($lang))
            $lang = Instance_L10n::get()->getLanguage();

        $this->redirect('/'.$lang.'/'.Instance_Routing::get()->getRootUrl().$path);
    }

}
