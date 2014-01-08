<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Profile
 *   Контроллер личного кабинета пользователя
 */
class Controller_Profile extends Controller_Authorized {

    /*
     * Страница редактирования профиля пользователя
     */
    public function action_index()
    {
        // передаем языковые константы
        $this->template->plugin_array = Instance_L10n::get()->getConstantsArray('profile/profile_page');

        // получаем вид и передаем туда необходимые значения
        //$view =
    }

}