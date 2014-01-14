<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Base
 *   Контроллер инсталятора системы
 */
class Controller_Install extends Controller_Base {

    /**
     * @var string шаблон инсталлятора
     */
    public $template = 'template_install';


    /**
     * Базовый action инсталлятора
     */
    public function action_index()
    {
        // генерируем CSRF токен (для защиты ajax)
        Instance_Security::get()->initCSRFToken();

        /*
         * Передача данных к шаблону
         */
        $this->template->lang_array = Instance_L10n::get()->getConstantsArray('install_page');
        $this->template->test_db_ajax = Instance_Routing::get()->route('core_install_test');
        $this->template->token = Instance_Security::get()->getCSRFToken();
    }


    /**
     * Проверка соединения с БД MySQL
     */
    public function action_test()
    {
        // защита от CSRF-атак (проверка)
        Instance_Security::get()->checkRequestToken();

        // отменяем отрисовку шаблона (так как обработчик ajax)
        $this->auto_render = false;

        if (($_POST['hostname'] == '') or ($_POST['login'] == '') or ($_POST['db'] == ''))
            die(false);

        // проверяем соединение с БД MySQL
        try
        {
            $link = mysqli_connect($_POST['hostname'], $_POST['login'], $_POST['password'], $_POST['db']);
            mysqli_close($link);
        }
        catch (Exception $e)
        {
            die(false);
        }

        die(true);
    }

}