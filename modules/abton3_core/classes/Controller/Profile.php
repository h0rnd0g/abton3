<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Profile
 *   Контроллер личного кабинета пользователя
 */
class Controller_Profile extends Controller_Authorized {

    public function before()
    {
        parent::before();

        // защита от CSRF-атак
        $this->template->token = Instance_Security::get()->getCSRFToken();
    }

    /*
     * Страница редактирования профиля пользователя
     */
    public function action_index()
    {
        $test = Data_Test_Object::create();
        $test->name = 'ololo';

        $model = Data_Test_Model::create(Data_Test_Mapper_SQL::create());
        //$model->add($test);

//        throw new Exception(var_dump(isset($test->id)));

        $view = View::factory('profile/profile_index');

        // передаем языковые константы
        $l10n_array = Instance_L10n::get()->getConstantsArray('profile/profile_page');

        $this->template->plugin_array = $l10n_array;
        $view->l10n_array = $l10n_array;

        // получаем вид и передаем туда необходимые значения
        $this->template->content = $view;
    }

}