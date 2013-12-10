<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Base
 *   Базовый контроллер ядра системы
 */
class Controller_Base extends Controller_Template {

    /*
     * Выполняется перед вызовом action'а
     * Содержит в себе проверку на язык
     */
    public function before()
    {
        parent::before();

        $language = $this->request->param('lng', null);
        $request_uri = $this->request->uri();

        if (!isset($language))
        {
            // если язык не задан, то делаем редирект на тот же URI, но с языком по умолчанию
            $language = Instance_L10n::get()->getLanguage();
            $this->redirect('/'.$language.'/'.$request_uri);
        }
        else
            try
            {
                // попытка задать язык
                Instance_L10n::get()->setLanguage($language);
            }
            catch (Exception $e)
            {
                if ($e->getCode() == Instance_L10n::ERROR_LANGUAGE_DOESNT_EXISTS) // якщо такої мови не існує
                {
                    // обрезаем вхождения несуществующою языка к запрашиваемой URI (включая слеш)
                    $seg1 = strpos($request_uri, '/');
                    $request_uri = substr($request_uri, $seg1+1);

                    $current_language = Instance_L10n::get()->getLanguage(); // получаем текущий язык (по умолчанию)

                    // делаем редирект по запрашиваемому URI, но уже с языком по умолчанию
                    $this->redirect('/'.$current_language.'/'.$request_uri);
                }
            }
    }

}