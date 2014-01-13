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
        /*
         * Передача данных к шаблону
         */
        $this->template->lang_array = Instance_L10n::get()->getConstantsArray('install_page');;
    }

}